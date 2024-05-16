@section('script')
<script src={{asset("assets/js/pages/dropify.min.js")}}></script>
<script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
<script>
      $(document).ready(function () {
            $('.dropify').dropify();

        let page = (window.location.href.indexOf('/catalog/products/edit/') > -1) ? true : false;
        if (page){
            const type = '{{ isset($productDetails->type) ? $productDetails->type : 'Simple Product'  }}';
            if (type == "Configured Product"){
                $('#originalprice').removeAttr('required').attr('disabled',true).val('');
                $('#profitpercentage').removeAttr('required').attr('disabled',true).val('');
                $('#sellingprice').removeAttr('required').attr('disabled',true).val('');
                $('#profit').removeAttr('required').attr('disabled',true).val('');
                $('#stocks').removeAttr('required').attr('disabled',true).val('');
            }
        }
        $('#originalprice').blur(function (e) {
            e.preventDefault();
            const cp = $(this).val();
            let ppercent = $('#profitpercentage').val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
            const sp = (ppercent !== 0) ? parseInt(cp) + (cp*(ppercent/100)) : cp ;
            const profit = (ppercent !== 0) ? (cp*(ppercent/100)) : ppercent ;
            $('#sellingprice').prop('value',sp);
            $('#profit').prop('value',profit);
        });
        $('#profitpercentage').blur(function (e) {
            e.preventDefault();
            const cp = $('#originalprice').val();

            let ppercent = $('#profitpercentage').val();
            ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);

            let profit = cp*(ppercent/100);
            console.log(profit,'profit');

            const sp = (ppercent !== 0) ? (parseInt(cp) + profit) : cp ;
            profit = (ppercent !== 0) ? profit : ppercent ;

            console.log(cp,'cp of blur');
            console.log((ppercent),'ppercent of blur');
            console.log(sp,'sp of blur');

            $('#sellingprice').prop('value',sp);
            $('#profit').prop('value',profit);
        });
        });
</script>
@endsection
