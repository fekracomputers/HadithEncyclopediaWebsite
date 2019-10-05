@foreach($book as $row)
    <div class="col-md-4 col-sm-6 col-xs-12 xs-device uk-margin-bottom">
        <div class="book-ui">

            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-5">
                    <a href=""><img src="{{asset('dist/img/book-cover.png')}}" class="img-responsive img-book" alt="كتاب" title="{{$row->title}}"></a>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-7 uk-margin-top margin-right-mins">
                    <h5 class="uk-margin-top">أسم الكتاب :  <span class="text-info"> <a
                                    href="{{url('/books/'.$row->bookid.'/'.slug_title($row->title))}}">{{$row->title}}</a></span></h5>
                    <h5>أسم المؤلف : <span class="text-info"> <a href="{{url('/single-authors/'.$row->authorid.'/'.slug_title($row->name))}}">{{$row->name}}</a></span></h5>
                </div>
            </div>

        </div>
    </div>
@endforeach
