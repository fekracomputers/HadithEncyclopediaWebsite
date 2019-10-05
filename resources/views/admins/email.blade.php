<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ar" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <style type="text/css">
        .header {
            background: #8a8a8a;
            direction: rtl;
        }
        .header .columns {
            padding-bottom: 0;
        }
        .header p {
            color: #fff;
            padding-top: 15px;
            direction: rtl;
            text-align: right;
        }
        .header .wrapper-inner {
            padding: 20px;
        }
        .header .container {
            background: transparent;
            direction: rtl;
            text-align: right;

        }
        table.button.facebook table td {
            background: #3B5998 !important;
            border-color: #3B5998;
        }
        table.button.twitter table td {
            background: #1daced !important;
            border-color: #1daced;
        }
        table.button.google table td {
            background: #DB4A39 !important;
            border-color: #DB4A39;
        }
        .wrapper.secondary {
            background: #f3f3f3;
        }
        .par-content{
            font-size: 18px !important;
            line-height: 36px;
        }
        .main-title{
            font-size: 22px !important;
            font-weight: 700;
        }
    </style>

</head>
<body dir="rtl">
<table class="twelve columns" dir="rtl">
    <tr>
        <td class="panel">


            <container>


                <row>
                    <columns small="12" class="first">

                        <h2>عزيزي المستخدم</h2>
                        <h3> لقد قمت بالتعليق علي هذا الموضوع  {!! $url !!}</h3>
                        <h3 class="main-title">التعليق  :</h3>
                        <p class="par-content"> {!! nl2br(e($comment)) !!}</p>
                        <h4>التاريخ : {{$date}}</h4>

                    </columns>
                </row>
                <hr>
                <wrapper class="secondary">

                    <spacer size="16"></spacer>

                    <row>
                        <columns large="6">
                            <callout class="primary">
                                <h3 class="main-title">إدارة الموقع :</h3>
                                <p class="par-content"> {!! nl2br(e($feedback)) !!}</p>
                                <h4>التاريخ : {{$redate}}</h4>
                            </callout>
                        </columns>
                        <columns large="6">
                            <h4>مع تحيات إدارة الموقع</h4>
                        </columns>
                    </row>
                </wrapper>
            </container>

        </td>
        <td class="expander"></td>
    </tr>
</table>
</body>
</html>