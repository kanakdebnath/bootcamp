<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $data['title'] }}</title>
  </head>
  <body>
    
  
  <div style="width:100%!important;background-color:#ececec;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue,sans-serif">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#ececec">
        <tbody>
            <tr style="border-collapse:collapse">
                <td align="center" bgcolor="#ececec" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                    <table width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px">
                        <tbody>
                            <tr style="border-collapse:collapse">
                                <td width="640" height="20" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                            </tr>

                          <tr style="border-collapse:collapse;">
                                <td width="640" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                    <table width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#8A0020" style="border-radius:6px 6px 0px 0px;background-color:#8A0020;color:#464646">
                                        <tbody>
                                            <tr style="border-collapse:collapse">
                                                <td width="15" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="350" valign="middle" align="left" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">

                                                </td>
                                                <td width="30" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="255" valign="middle" align="right" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                                    <table width="255" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse">
                                                                <td width="255" height="5" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table width="255" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse">
                                                                <td width="255" height="5" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td width="15" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                            <tr style="border-collapse:collapse">

                                <td width="640" align="center" bgcolor="#F3F8FF" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">

                                    <div align="center" style="text-align:center">
                                        <a href="http://openweblife.createsend4.com/t/d-i-ftrgl-l-d/" target="_blank" style="font-size:36px; color:#fff; text-decoration:none; font-family:'calibri', arial, verdana; display:block; margin:20px 0 0;">
                                        <img style="width: 50%;"
                                            class="img-fluid "
                                            src="{{asset(Storage::url('uploads/logo/dark_logo.png'))}}"
                                            alt=""
                                            />
                                        </a><br /><br />
                                    </div>


                                </td>
                            </tr>

                            <tr style="border-collapse:collapse">
                                <td width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                            </tr>
                            <tr style="border-collapse:collapse">
                                <td width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                    <table align="left" width="640" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr style="border-collapse:collapse">
                                                <td width="30" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="580" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">

                                                    <table width="580" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse">
                                                                <td width="580" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                                                    <p align="center" style="font-size:18px;line-height:24px;color:#8a0020;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue,sans-serif">Hi {{ $data['user']->name }},  {{ $data['title'] }}</p>
                                                                    <div align="left" style="font-size:13px;line-height:18px;color:#464646;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue,sans-serif">
                                                                        <table border="0" cellpadding="5" cellspacing="0" width="100%" style="font-size:13px;font-family:'calibri',arial,verdana;line-height:1.4">
                                                                            <tbody>

                                                                                <tr style="border-collapse:collapse">
                                                                                    <td width="25%" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                                                                        <strong>Login Link:</strong>
                                                                                    </td>
                                                                                    <td width="70%" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                                                                        <a target="_blank" href="{{ route('login') }}">{{ route('login') }}</a>
                                                                                    </td>
                                                                                </tr>


                                                                                <tr style="border-collapse:collapse">
                                                                                    <td width="25%" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                                                                        <strong>Username:</strong>
                                                                                    </td>
                                                                                    <td width="70%" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                                                                    {{ $data['user']->email }}</td>
                                                                                </tr>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                                                                        <strong>Password:</strong>
                                                                                    </td>
                                                                                    <td style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                                                                    {{ $data['user']->user_password }}</td>
                                                                                </tr>
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td width="580" height="10" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                                <td width="30" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-collapse:collapse">
                                <td width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                            </tr>

                            <tr style="border-collapse:collapse">
                                <td width="640" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse">
                                    <table width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ec1c23" style="border-radius:0px 0px 6px 6px;background-color:#ec1c23;color:#e2e2e2">
                                        <tbody>
                                        <tr style="border-collapse:collapse">
                                                <td width="30" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="360" height="10" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="60" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="160" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="30" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                            </tr>
                                            <tr style="border-collapse:collapse">
                                                <td width="30" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="360" height="15" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="60" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="160" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                                <td width="30" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-collapse:collapse">
                                <td width="640" height="60" style="font-family:HelveticaNeue,sans-serif;border-collapse:collapse"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <img src="https://ci3.googleusercontent.com/proxy/1Bf6wZ9D4_9D4XK1CLH23Tl727SqwAxtj2mvfZ0Hn5vWCT0Zbtb6SSOSb-KYRCmmIUG5ITKLhN1d9n-rzhxQZKE=s0-d-e1-ft#https://createsend4.com/t/d-o-ftrgl-l/o.gif" width="1" height="1" border="0" alt="" style="min-height:1px!important;width:1px!important;border-width:0!important;margin-top:0!important;margin-bottom:0!important;margin-right:0!important;margin-left:0!important;padding-top:0!important;padding-bottom:0!important;padding-right:0!important;padding-left:0!important;outline-style:none;text-decoration:none;display:block">
</div>


  </body>
</html>