@extends('home.main')
@section('description')
    موسوعة الحديث احاديث و موضوعات ومؤلفين وكتب ورواه الاحاديث
@endsection
@section('keywords')
    عن الموقع, موقع موسوعة الحديث
@endsection
@section('title')
    : {{$title}}
@endsection

@section('content')
    <div class="about">
        <div class="panel-body">
            <h3 class="text-info">من نحن :</h3>
            <div class="first uk-margin-top">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img src="{{asset('dist/img/web-about.jpg')}}" alt="development" title="application software" class="img-responsive">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <p class="more-height">
                            تعتبر شركة فكرة من إحدي شركات البرمجة التي تتمتع بالخبرة في مجال تصميم تطبيقات المحمول والمواقع الإليكترونية،لدينا فريق عمل قوي ، ذو خبرة عميقة في تطوير الأدوات التكنولوجية الرئيسية المختلفة من جافا، دوت نت، بالإضافة إلي معرفتنا العميقة بالأي فون والاندرويد والبلاك بيري .
                        </p>
                    </div>
                </div>
            </div>
            <div class="second uk-margin-top">
                <div class="row">

                    <div class="col-md-8 col-sm-8">
                        <p class="more-height">
                            فكرة تحتل مكان فريد من بين المئات من الشركات المحترفة في البرمجة وشركات تصميم المواقع الإليكترونية ، فنحن لا نكتفي فقط بتقديم خدمة او منتج ولكننا نقدم افضل الوسائل والحلول المتاحة التي تتناسب مع المتطلبات المالية والوظيفية لعملائنا . إن تحليلاتنا الديمجرافية التنافسية والتي هي في عمق السوق تمكن شركتنا من إنتاج تحسينات مثلى لمحركات البحث لا يستطيع منافسينا إنتاجها بنفس المستوى . نحن نهدف باستمرار لعمل حلول مختلفة بناءًا على متطلبات عملائنا المالية واستراتيجياتهم الدقيقة تقود إلى علاقات عمل مستمرة وطويلة المدى . نتمنى مساعدتكم.                         </p>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <img src="{{asset('dist/img/services-about.jpg')}}" alt="services" title="Web Services" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{action('HomeController@comment',[ 'url' =>'about','type'=>'about','label'=>'عن الموقع'])}}" class="btn btn-primary btn-ms"> أضف تعليق</a>
            </div>

        </div>
    </div>

@endsection