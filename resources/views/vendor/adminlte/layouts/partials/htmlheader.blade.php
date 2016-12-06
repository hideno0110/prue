<head>
    <meta charset="UTF-8">
    <title> Prue - {{ trans('adminlte_lang::message.sub_title') }}  </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--住所取得--}}
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
   
    {{--jquery--}}
    <link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    
    {{--google map--}}
    <script src="https://rawgit.com/HPNeo/gmaps/master/gmaps.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&callback=initMap" type="text/javascript"></script>
    {{-- chart.js --}}
    <script src="{{asset("/plugins/chartjs/Chart.min.js")}}" type="text/javascript"></script>
    
    {{--inline edit //ajax制御用--}}
    <script type="text/javascript" src="{{ asset('/js/inlineedit.js')}}"></script>

    <link href="{{ asset('/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
   </script>

 
<script>
    $(function () {
        var dateFormat = 'yy-mm-dd';
        $('#datepicker').datepicker({
            dateFormat: dateFormat
        });
    })

</script>
<script>
//    http://d.hatena.ne.jp/gloryof/20140102/1388670210
    $(document).ready(function(){
        $('#foo-table').DataTable({
            iDisplayLength : 100,

        });

    });
</script>
 </head>
