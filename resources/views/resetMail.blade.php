<p> Dear {{ $name }},</p><br>

<p> You received this email because you have requested to reset your password at the CS Research website. 
Please click on the following Password Reset URL if it is you who have requested for the reset. 
If it is not you then just ignore the mail.</p><br>
<p>
User Id: {{ $id }}<br>
Password reset URL: https://localhost:8000/resetPage?token={{ $token }}
</p><br>
<p>
Warm Regards,
CS Intern Management Team
</p><br>