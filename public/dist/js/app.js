$( document ).ready(function() {
    $(window).resize();
    /*load more function*/
    function loadmore(eleId, loadPath, fetchId, calc, cat) {
        $('body').on('click', eleId, function (e) {
            var id = $(this).data('id');
            var path = loadPath;
            var token = $('#csrf').val();
            var catId = $(cat).val();
            var $this = $(this);

            $(this).text('Loading ...');
            $.ajax({
                type: 'POST',
                url: path,
                data: {
                    "_token": token,
                    "id": id,
                    "catid": catId
                },
                success: function (html) {
                    $('#loadtopic').hide();

                    if (html == '') {
                        $(eleId).hide();
                    } else {
                        $(fetchId).append(html);
                        $(eleId).text('أكثر');
                        $(eleId).data('id', id + calc);
                    }
                }
            });

        });

    }

    /*Filter Function by keyup*/
    function FilterLive(eleId, loadPath, fetchId, HideMore, cat) {
        $(eleId).keyup(function (e) {
            var searchLen = $.trim($(this).val()).length;
            var searchText = $.trim($(this).val());
            var $this = searchText;
            var catId = $(cat).val();
            if ((e.keyCode != 16) && (e.keyCode != 18)) {
                $(HideMore).hide();
                if (searchLen > 2) {

                    $.ajax({
                        type: 'GET',
                        url: loadPath,
                        data: {
                            "text": searchText,
                            "catid": catId
                        },
                        success: function (html) {
                            $(fetchId).html('');
                            $(fetchId).append(html);
                            return false ;
                        }
                });
                } else {
                    if ($this == '') {
                        location.reload();
                    }
                }
                return false ;

            }
        });

    }

    /*search topic filter*/
    FilterLive('#topic-filter', '/searchtopic', '#topic', '#loadtopic');

    /*search Authors filter*/
    FilterLive('#author-filter', '/searchauthor', '#authors', '#loadauthor');


    /*search books filter*/
    FilterLive('#single-filter', '/searchbook', '#books', '#loadbook', "#catid");

    /*search all books filter*/
    FilterLive('#books-filter', '/searchallbooks', '#books', '#loadall');

    /*search books filter*/
    FilterLive('#title-filter', '/searchtitle', '#accordion', '#loadtitle', "#bookid");

    /*load more Author*/
    loadmore('#loadauthor', '/loadauthor', '#authors', 9);


    /*narrators load and live search*/
    $('body').on('click', '#loadnarrators', function (e) {
        var id = $(this).data('id');
        var path = '/loadnarrators';
        var $this = $(this);

        $(this).text('Loading ...');
        $.ajax({
            type: 'GET',
            url: path,
            data: {
                "id": id,
            },
            success: function (html) {

                if (html == '') {
                    $this.hide();
                } else {
                    $this.text('أكثر');
                    $this.data('id', id + 9);
                    $('#narratorid').append(html);
                }
            }
        });

    });

        $('#rawy-filter').keyup(function (e) {
            var searchLen = $.trim($('#rawy-filter').val()).length;
            var searchText = $.trim($('#rawy-filter').val());
            var $rotba = $.trim($('#rotba').val());
            var $this = searchText;
            if ((e.keyCode != 16) && (e.keyCode != 18)) {
                $('#loadnarrators').hide();
                if (searchLen > 3) {

                    $('#narratorid').html('');
                    $.ajax({
                        type: 'GET',
                        url: '/searchnarrators',
                        data: {
                            "text": searchText,
                            "rotba":$rotba
                        },
                        success: function (html) {
                            $('#narratorid').html('');
                            $('#narratorid').append(html);
                            var $counter = $('#counter').data('counter');
                            var $page = $('#page').data('page');
                            if ($counter > $page){
                                $('#loadMoreNarr').show();
                            }
                        }
                    });
                } else {
                    if ($this == '') {
                        location.reload();
                    }
                }
            }
        });
        $('body').on('change','#rotba',function(e){
            var searchText = $.trim($('#rawy-filter').val());
            var $rotba = $.trim($('#rotba').val());
            $.ajax({
                type: 'GET',
                url: '/searchnarrators',
                data: {
                    "text": searchText,
                    "rotba": $rotba,
                },
                success: function (html) {
                    $('#narratorid').html('');
                    $('#loadnarrators').hide();
                    $('#narratorid').append(html);
                    var $counter = $('#counter').data('counter');
                    var $page = $('#page').data('page');
                    if ($counter > $page){
                        $('#loadMoreNarr').show();
                    }
                }
            });
        });

        $('body').on('click', '#loadMoreNarr', function (e) {
        var page = $(this).data('id') + 1;
        var text = $('#rawy-filter').val();
        var $rotba = $.trim($('#rotba').val());
        var $this = $(this);
        var path = '/loadsearchnarrators?search='+text+'&rotba='+$rotba+'&page='+page+'';
        // var token = $('#csrf').val();
        $('#loadMoreNarr').text('Loading ...');

        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if (html != '') {
                    $('#narratorid').append(html);
                    $('#loadMoreNarr').data('id', page);
                    $('#loadMoreNarr').text('أكثر');
                }else{
                    $this.hide();
                }
            }
        });

    });
        $('body').on('dblclick','#hadithid',function () {
            var hadithid = $(this).data('id');
            var bookid = $(this).data('book');
            var slug = $(this).data('slug');
            var editableText = $("<input type='text' data-slug="+slug+" data-book="+bookid+" data-subject='0' class='form-control searchid' name='hadithid' value="+hadithid+">");
            $(this).replaceWith(editableText);
        });
/*end narrator Live search and effect*/

    /*load more all books*/
    loadmore('#loadall', '/loadallbooks', '#books', 9);

    /*load more topic*/
    loadmore('#loadtopic', '/loadtopic', '#topic', 9, '#loadtopic');

    /*load more title*/
    $('body').on('click', '#loadtitle', function (e) {
        var page = $(this).data('id') + 1;
        var id = $(this).data('bookid');
        var counter = $(this).data('counter');
        var path = '/loadtitle?page='+page+'&id='+id;
        // var token = $('#csrf').val();
        $(this).text('loading ...');
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if(counter <= page){
                    $('#loadtitle').hide();
                }
                if (html != '') {
                    $('#accordion').append(html);
                    $('#loadtitle').data('id', page);
                    $('#loadtitle').text('أكثر');

                }
            }
        });
        return false;

    });


    /*load child title*/

    $('body').on('click', '#subtitle', function (e) {
        var id = $(this).data('id');
        var path = '../../loadsubtitle';
        var token = $('#csrf').val();
        var bookId = $('#bookid').val();
        var self = $(this);

        $.ajax({
            type: 'POST',
            url: path,
            data: {
                "_token": token,
                "id": id,
                "catid": bookId
            },
            success: function (html) {

                if (html != '') {
                    $("#collapse" + id).append(html);
                    self.removeAttr('id');
                    self.data('id', ' ');

                }
            }
        });

    });

    /*Next and Prev btn*/
    $('body').on('click', '#data-next', function (e) {
        var bookid = $(this).data('book');
        var title = $(this).data('title');
        var hId = $(this).data('id');
        var hadithid = $(this).data('id') + 1;
        var subjectid = $(this).data('subject');
        var slug = $(this).data('slug');
        var path = '/loadhadith';
        var token = $('#csrf').val();
        var hrf = '/single-book/' + bookid + '/' + slug + '/' + subjectid + '/' + hadithid + '';
        var comment = 'single-book/' + bookid + '/' + slug + '/' + subjectid + '/' + (hId +1) +'' ;
        $('.img-tef').hide();
        $.ajax({
            type: 'POST',
            url: path,
            data: {
                "_token": token,
                "id": hadithid,
                "subjectid": subjectid,
                "bookid": bookid
            },
            success: function (html) {
                if (html != '') {
                    $('.hadith-panel').html(html);
                    $('#data-next').attr('href', hrf);
                    $('.rawy').each(function () {
                        var id = $(this).attr('id');
                        var text = $(this).text();
                        var path = $(this).attr('href', '/narrators/' + id + '/' + text);
                    });
                    $('.rawy').each(function () {
                        var id = $(this).attr('id');
                        var text = $(this).text();
                        var path = $(this).attr('href', '/narrators/' + id + '/' + text);
                        var $this = $(this);

                        $('.effect').each(function(){
                            if($(this).data('id')== id){
                                var rotba = $(this).data('rotba');
                                $this.css( {
                                    "color": rotba +"!important","font-weight":"bold"});
                            }
                        });
                    });

                    $('#comment').attr('href', '/comment?url=' + comment + '&type=hadith'+'&label='+ title +' - '+(hId +1));
                    LoadTefseer();

                }
            }
        });
        return false;

    });

    $('body').on('click', '#data-prev', function (e) {
        var bookid = $(this).data('book');
        var title = $(this).data('title');
        var hId = $(this).data('hadith');
        var hadithid = $(this).data('id') - 1;
        var subjectid = $(this).data('subject');
        var path = '/loadhadith';
        var token = $('#csrf').val();
        var $this = $(this);
        var slug = $(this).data('slug');
        var hrf = '/single-book/' + bookid + '/' + slug + '/' + subjectid + '/' + hadithid + '';
        var comment = 'single-book/' + bookid + '/' + slug + '/' + subjectid + '/' + (hId -1)  ;
        $('.img-tef').hide();
        $.ajax({
            type: 'POST',
            url: path,
            data: {
                "_token": token,
                "id": hadithid,
                "subjectid": subjectid,
                "bookid": bookid
            },
            success: function (html) {
                if (html != '') {
                    $('.hadith-panel').html(html);
                    $('#data-prev').attr('href', hrf);

                    $('.rawy').each(function () {
                        var id = $(this).attr('id');
                        var text = $(this).text();
                        var path = $(this).attr('href', '/narrators/' + id + '/' + text);
                    });
                    $('.rawy').each(function () {
                        var id = $(this).attr('id');
                        var text = $(this).text();
                        var path = $(this).attr('href', '/narrators/' + id + '/' + text);
                        var $this = $(this);

                        $('.effect').each(function(){
                            if($(this).data('id')== id){
                                var rotba = $(this).data('rotba');
                                $this.css( {
                                    "color": rotba +"!important","font-weight":"bold"});
                            }
                        });
                    });

                    $('#comment').attr('href', '/comment?url=' + comment + '&type=hadith'+'&label='+ title +' - '+(hId -1));
                    LoadTefseer();


                }
            }
        });
        return false;

    });
    /*end next and prev*/

    $('body').on('keypress', '.searchid', function (e) {
        if (e.keyCode == 13){
            var bookid = $(this).data('book');
            var title = $(this).data('title');
            var hId = $(this).data('hadith');
            var hadithid = $(this).val();
            var $this = $(this);
            var subjectid = $(this).data('subject');
            var path = '/loadhadith';
            var token = $('#csrf').val();
            var slug = $(this).data('slug');
            var hrf = '/single-book/' + bookid + '/' + slug + '/' + subjectid + '/' + hadithid + '';
            var comment = 'single-book/' + bookid + '/' + slug + '/' + subjectid + '/' + (hId - 1);
            $('.img-tef').hide();
            $.ajax({
                type: 'POST',
                url: path,
                data: {
                    "_token": token,
                    "id": hadithid,
                    "subjectid": subjectid,
                    "bookid": bookid
                },
                success: function (html) {
                    if (html != '') {
                        $('.hadith-panel').html(html);
                        $('.rawy').each(function () {
                            var id = $(this).attr('id');
                            var text = $(this).text();
                            var path = $(this).attr('href', '/narrators/' + id + '/' + text);
                        });
                        $('.rawy').each(function () {
                            var id = $(this).attr('id');
                            var text = $(this).text();
                            var path = $(this).attr('href', '/narrators/' + id + '/' + text);
                            var $this = $(this);

                            $('.effect').each(function(){
                                if($(this).data('id')== id){
                                    var rotba = $(this).data('rotba');
                                    $this.css( {
                                        "color": rotba +"!important","font-weight":"bold"});
                                }
                            });
                        });
                        LoadTefseer();

                        $('#comment').attr('href', '/comment?url=' + comment + '&type=hadith' + '&label=' + title + ' - ' + (hId - 1));


                    }
                }

            });
            return false;
    }});

    $('body').on('click', '.command', function (e) {
        var bookid = $(this).data('book');
        var title = $(this).data('title');
        var hId = $(this).data('hadith');
        var subjectid = 0;
        var hadithid = $(this).data('id');
        var path = '/loadhadith';
        var token = $('#csrf').val();
        var slug = $(this).data('slug');
        var $this = $(this);
        var hrf = '/single-book/' + bookid + '/' + slug + '/' + 0 + '/' + hadithid + '';


        $.ajax({
            type: 'POST',
            url: path,
            data: {
                "_token": token,
                "id": hadithid,
                "subjectid": subjectid,
                "bookid": bookid
            },
            success: function (html) {
                if (html != '') {
                    $('.hadith-panel').html(html);
                    $this.attr('href', hrf);

                    $('.rawy').each(function () {
                        var id = $(this).attr('id');
                        var text = $(this).text();
                        var path = $(this).attr('href', '/narrators/' + id + '/' + text);
                        var $this = $(this);

                        $('.effect').each(function(){
                            if($(this).data('id')== id){
                                var rotba = $(this).data('rotba');
                                $this.css( {
                                    "color": rotba +"!important","font-weight":"bold"});
                            }
                        });
                    });
                    return false;
                }
            }
        });

    });

    /*load more search result*/
    $('body').on('click', '#loadsearch', function (e) {
        var id = $(this).data('id') + 1;
        var text = $(this).data('search');
        var path = '?search=' + text + '&page=' + id;
        // var token = $('#csrf').val();
        $('#loadsearch').text('loading ...');
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if (html != '') {
                    $('#search-result').append(html);
                    $('#loadsearch').data('id', id);
                    $('#loadsearch').text('أكثر');

                }
            }
        });
        return false;

    });

    $('body').on('click', '#loadHadith', function (e) {
        var page = $(this).data('page') + 1;
        var id = $(this).data('id');
        var counter = $(this).data('counter');
        var path = '/loadnarratorshadith/'+id+'?page=' + page;
        // var token = $('#csrf').val();
        $(this).text('loading ...');
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if(counter <= id){
                    $('#loadHadith').hide();
                }
                if (html != '') {
                    $('#search-result').append(html);
                    $('#loadHadith').data('page', page);
                    $('#loadHadith').text('أكثر');

                }else{
                    $('#loadHadith').hide();
                }
            }
        });
        return false;

    });

    $('body').on('click', '#loadbook', function (e) {
        var page = $(this).data('page') + 1;
        var bookid = $(this).data('id');
        var path = '?page=' + page;
        // var token = $('#csrf').val();
        $('#loadbook').text('loading ...');
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if (html != '') {
                    $('#books').append(html);
                    $('#loadbook').data('page', page);
                    $('#loadbook').text('أكثر');

                }
            }
        });
        return false;

    });

    /*rawy add links to rawy*/
    $('.rawy').each(function () {
        var id = $(this).attr('id');
        var text = $(this).text();
        var path = $(this).attr('href', '/narrators/' + id + '/' + text);
        var $this = $(this);

        $('.effect').each(function(){
            if($(this).data('id')== id){
                var rotba = $(this).data('rotba');
                $this.css( {
                    "color": rotba +"!important","font-weight":"bold"});
            }
        });
    });

    /*search auto complete*/

    $('body').on('keydown', '#seInput', function (){
        var lastVal  = $(this).val().replace(/,\s*/, ' ');
        function split(val) {
            return val.split(/ \s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        function extractFirst(item) {
            return split(item.replace(',',' ')).slice(0,-1);
        }
        $(this)
            .on("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                source: function (request, response) {
                    $.getJSON("/loadsearchitem", {
                        term: extractLast(request.term)
                    }, response);
                },
                search: function () {
                    // custom minLength
                    var term = extractLast(this.value);
                    if (term.length < 2) {
                        return false;
                    }
                },
                focus: function () {
                    // prevent value inserted on focus

                    return false;
                },
                select: function (event, ui) {

                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.word);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(" ");
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item ,mainVal) {
            if(lastVal.split(' ').length > 1){
                return $("<li>")
                    .append("<div>" + ' <span class="green">' + extractFirst(lastVal) + ' <span class="red">' + item.word + "</span></div>")
                    .appendTo(ul);
            }
            else {
                return $("<li>")
                    .append("<div>" + ' <span>' + item.word + "</span></div>")
                    .appendTo(ul);
            }
        };

    });

        /*delete cookies*/
   $('.close-cookie').click(function(){
            var id = $(this).data('id');
            var path = '/deletecookie'
            $('#cookie'+id).fadeOut(500);
            $.ajax({
                type: 'GET',
                url: path,
                data :{id : id},
                success: function (html) {

                }
            });
            return false ;

        });
    function LoadTefseer () {
        var HadithId = $('#data-prev').data('id');
        var BookId = $('#data-prev').data('book');
        var path = "http://hadithapi.islam-db.com/api/gettafseer/"+BookId+"/"+HadithId ;
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if (html.length > 0) {
                    $('.img-tef').show();
                    var Lenval = html.length ;
                        $.each(html,function(key , val){

                            $("#test").append("<div class='col-sm-6'><div class='panel panel-default'>" +
                                "<div class='panel-body text-center'>" +
                                "<img src='/dist/img/books.png' class='img-book'>" +
                                "<a href='/getTefsser/"+val.tafseerbookid+"/"+val.tafseerpageid+"'><h3 class='text-info'>"+val.tafseerbooktitle+"</h3></a></div></div>" +
                                "</div>");

                        });
                }
            }
        });


    }
    LoadTefseer();

    /*Next and Prev For Tefseer*/
    $('body').on('click', '#tefser-next', function (e) {
        var bookid = $(this).data('book');
        var hId = $(this).data('hadith')+1;
        var path = "/getTefsserContain/"+bookid+"/"+hId+"" ;
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if (html != '') {
                    $('.hadith-panel').html(html);
                }
            }
        });
        return false;

    });
    $('body').on('click', '#tefser-first', function (e) {
        var bookid = $(this).data('book');
        var hId = $(this).data('id');
        var path = "/getTefsserContain/"+bookid+"/"+hId+"" ;
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if (html != '') {
                    $('.hadith-panel').html(html);
                }
            }
        });
        return false;

    });
    $('body').on('click', '#tefser-prev', function (e) {
        var bookid = $(this).data('book');
        var hId = $(this).data('hadith')-1;
        var path = "/getTefsserContain/"+bookid+"/"+hId+"" ;
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if (html != '') {
                    $('.hadith-panel').html(html);
                }
            }
        });
        return false;

    });
    $('body').on('click', '#tefser-last', function (e) {
        var bookid = $(this).data('book');
        var hId = $(this).data('id');
        var path = "/getTefsserContain/"+bookid+"/"+hId+"" ;
        $.ajax({
            type: 'GET',
            url: path,
            success: function (html) {
                if (html != '') {
                    $('.hadith-panel').html(html);
                }
            }
        });
        return false;

    });
    $('body').on('dblclick','#hadithtef',function () {
        var hadithid = $(this).data('id');
        var bookid = $(this).data('book');
        var editableText = $("<input type='text' data-book="+bookid+" class='form-control searchtef' name='hadithid' value="+hadithid+">");
        $(this).replaceWith(editableText);
    });
    $('body').on('keypress', '.searchtef', function (e) {
        if (e.keyCode == 13){
            var bookid = $(this).data('book');
            var hId = $(this).val();
            var path = "/getTefsserContain/"+bookid+"/"+hId+"" ;
            $.ajax({
                type: 'GET',
                url: path,
                success: function (html) {
                    if (html != '') {
                        $('.hadith-panel').html(html);
                    }
                }
            });
            return false;
        }});


});
