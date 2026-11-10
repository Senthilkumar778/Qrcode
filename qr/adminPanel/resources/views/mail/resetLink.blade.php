<div>
    @php 
        $mailData['body'] = str_replace('[RESET_LINK]', '<a href="' . route('resetPassword', $mailData['token']) . '">Reset Your Password</a>', $mailData['body']); 
        $mailData['body'] = str_replace('[USER_NAME]', $mailData['userName'], $mailData['body']);
        $mailData['body'] = str_replace('[SUPPORT_EMAIL]', $mailData['supportEmail'], $mailData['body']);
    @endphp
    {!! $mailData['body'] !!}
</div>
