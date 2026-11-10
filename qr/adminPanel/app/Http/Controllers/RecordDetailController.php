<?php

namespace App\Http\Controllers;

use App\Models\NewEnquiry;
use App\Models\NewEnquiryHistory;
use App\Models\ServiceInfo;
use App\Models\ServiceInfoHistory;
use App\Models\User;
use Carbon\Carbon;

/*
| One controller for BOTH record types:
|   $type = 'serviceInfo'  -> Service Info record  (S11232)
|   $type = 'newEnquiry'   -> New Enquiry record   (N10657)
|
| popup()   -> JSON used by the dashboard popup
| details() -> the full "Detailed View" page
*/
class RecordDetailController extends Controller
{
    public function __construct(){
        date_default_timezone_set('asia/kolkata');
    }

    // data for the dashboard popup
    public function popup($type, $id){
        return response()->json($this->build($type, (int) $id));
    }

    // full page (opens in a new tab)
    public function details($type, $id){
        $data = $this->build($type, (int) $id);
        return view('record.details', compact('data'));
    }

    // collects everything about one record
    private function build(string $type, int $id): array
    {
        if ($type === 'serviceInfo') {
            $record      = ServiceInfo::findOrFail($id);
            $historyRows = ServiceInfoHistory::where('serviceInfoID', $id)->orderBy('id', 'desc')->get();
            $label       = 'Service Info';
            $code        = 'S' . $id;
            $rawFiles    = $record->issueImages;
            $editUrl     = route('editServiceInfo', $id);
            $listUrl     = route('serviceInfo');
        } else {
            $record      = NewEnquiry::findOrFail($id);
            $historyRows = NewEnquiryHistory::where('newEnquiryID', $id)->orderBy('id', 'desc')->get();
            $label       = 'New Enquiry';
            $code        = 'N' . $id;
            $rawFiles    = $record->images;
            $editUrl     = route('editNewEnquiry', $id);
            $listUrl     = route('newEnquiries');
        }

        // same rule as the list pages: only these roles see every region
        $user = auth()->user();
        $seesAllRegions = in_array($user->userRole, ['SystemSpecialist', 'SuperAdmin', 'Admin', 'Manager']);
        if (!$seesAllRegions && (string) $record->regionID !== (string) $user->regionID) {
            abort(403, 'You cannot view this record.');
        }

        // names of the staff members (last updated by / history)
        $userIds = $historyRows->pluck('userID')->push($record->userID)->filter()->unique()->values();
        $users   = User::whereIn('id', $userIds)->get()->keyBy('id');
        $nameOf  = function ($userId) use ($users) {
            return isset($users[$userId]) ? trim($users[$userId]->firstName . ' ' . $users[$userId]->lastName) : null;
        };

        $when = $record->requestTime ?: $record->createdAt;

        $history = [];
        foreach ($historyRows as $h) {
            $history[] = [
                'status'   => $h->status ?: '-',
                'at'       => $this->fmt($h->createdAt),
                'by'       => $nameOf($h->userID),
                'interval' => $h->timeInterval ?: '',
                'remarks'  => $this->text($h->remarks),
            ];
        }

        return [
            'type'       => $type,
            'label'      => $label,
            'code'       => $code,
            'title'      => $label . ' ' . $code,
            'status'     => $record->status ?: '-',
            'raisedAgo'  => $when ? Carbon::parse($when)->diffForHumans() : '',
            'raisedAt'   => $this->fmt($when),
            'customer'   => [
                'name'  => $record->name ?: '-',
                'email' => $record->email ?: '',
                'phone' => $record->phoneNumber ?: '',
                'ip'    => $record->reqIpAddr ?: '-',
            ],
            'details'    => [
                'product'     => $record->productType ?: '-',
                'subcategory' => $record->subcategoryName ?: '-',
                'location'    => $record->locationName ?: '-',
                'region'      => $record->regionName ?: '-',
                'requestTime' => $this->fmt($record->requestTime),
                'lastUpdated' => $this->fmt($record->updatedAt),
                'updatedBy'   => $nameOf($record->userID),
            ],
            'issue'       => $this->text($record->issueDescription),
            'remarks'     => $this->text($record->remarks),
            'attachments' => $this->files($rawFiles),
            'history'     => $history,
            'editUrl'     => $editUrl,
            'detailsUrl'  => route('recordDetails', ['type' => $type, 'id' => $id]),
            'listUrl'     => $listUrl,
        ];
    }

    // 15 Oct 2026, 10:52 am
    private function fmt($value): string
    {
        if (!$value) {
            return '-';
        }
        try {
            return Carbon::parse($value)->format('d M Y, h:i a');
        } catch (\Exception $e) {
            return (string) $value;
        }
    }

    // plain text: the old edit page saved line breaks as <br />, so turn them back into new lines
    private function text($value): string
    {
        if ($value === null || trim((string) $value) === '') {
            return '';
        }
        $value = preg_replace('/<br\s*\/?>/i', "\n", (string) $value);
        return trim(html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }

    // "support_issues/a.jpg|support_issues/b.mp4"  ->  list of [url, name, type]
    private function files($raw): array
    {
        $raw = trim((string) $raw);
        if ($raw === '' || $raw === '[]') {
            return [];
        }

        $json  = json_decode($raw, true);
        $paths = is_array($json) ? $json : explode('|', $raw);

        $files = [];
        foreach ($paths as $path) {
            $path = trim((string) $path, " \t\n\r\0\x0B\"'");
            if ($path === '') {
                continue;
            }

            if (preg_match('#^https?://#i', $path)) {
                $url = $path;
            } else {
                $dir = dirname($path);
                $dir = ($dir === '.') ? '' : $dir . '/';
                $url = asset($dir . rawurlencode(basename($path)));
            }

            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $files[] = [
                'url'  => $url,
                'name' => basename($path),
                'type' => in_array($ext, ['mp4', 'mov', 'm4v', 'webm', '3gp', 'avi', 'mkv']) ? 'video' : 'image',
            ];
        }

        return $files;
    }
}