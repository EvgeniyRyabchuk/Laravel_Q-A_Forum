
<style type="text/css">
    /*.bootstrap-tagsinput .tag {*/
    /*    margin-right: 2px;*/
    /*    color: white !important;*/
    /*    background-color: #0d6efd;*/
    /*    padding: 0.2rem;*/
    /*}*/
    .bootstrap-tagsinput {
        display: flex;
        align-items: center;
    }
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white;
        text-decoration: none;
        display: flex !important;
        justify-content: center;
        align-items: center;
    }
    .tag {
        display: inline-block !important;
        /*height: 100%;*/
    }
    .bootstrap-tagsinput .tag [data-role="remove"] {
        margin-left: 8px;
        cursor: pointer;
        display: block !important;

    }
    .label-info {
        background-color: #5bc0de;
        font-size: 30px;
    }
    .label {
        display: inline;
        padding: 0.2em 0.6em 0.3em;
        font-size: 30px;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25em;
    }

    .bootstrap-tagsinput .tag [data-role="remove"]:after {
        content: "X";
        padding: 0px 2px;
        margin-left: 10px;
        /*font-size: 30px;*/

    }

    #tagInput {
        /*height: 30px !important;*/
    }
    .bootstrap-tagsinput > input {
        width: 200px !important;
        height: 40px;
        font-size: 30px;
        /*outline: none;*/
        /*border: 0;*/
    }
    .bootstrap-tagsinput {
        display: flex;
        flex-wrap: wrap;
    }
</style>

<div class="input-group my-3 row">
    <input
        value=""
        id="tagInput"
        type="text"
        class="form-control p-4"
        data-role="{{isset($question) ? 'tagsinput fghj'  : 'tagsinput'}}"
        name="tags"
    />
    <input type="hidden" name="tagList" id="hiddenTagValue">
</div>

@section('js')

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"
></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>

    let tags = [];
    let oldTags = [];
    {{--@dd($question->tags)--}}
    document.getElementById('btn-submit').onclick = (e) => {
        document.getElementById('hiddenTagValue').value = oldTags.concat(tags).join(',');
        document.querySelector('#updForm').submit();
    }
    function setTag(event) {

        var $element = $(event.target);
        var $container = $element.closest('.example');
        console.log(1)
        if (!$element.data('tagsinput')) return;
        console.log(2)
        var val = $element.val();
        if (val === null) val = 'null';
        var items = $element.tagsinput('items');
        console.log(val)
        if(val !== 'null')
            document.getElementById('hiddenTagValue').value += ','+val;

        $('code', $('pre.val', $container)).html(
            $.isArray(val)
                ? JSON.stringify(val)
                : '"' + val.replace('"', '\\"') + '"'
        );
        $('code', $('pre.items', $container)).html(
            JSON.stringify($element.tagsinput('items'))
        );
        console.log('end event')
    }



    window.onload = () => {

        // $('.bootstrap-tagsinput input').on('change', setTag).trigger('change');
        @isset($question)
            $('#tagInput').tagsinput({
                allowDuplicates: false,
                itemValue: 'id',  // this will be used to set id of tag
                itemText: 'label' // this will be used to set text of tag
            });
            @foreach($question->tags as $tag)
                oldTags.push("{!! $tag->name !!}");
                {{--document.getElementById('hiddenTagValue').value += '{{$tag->name . ','}}';--}}
                $('#tagInput').tagsinput('add', { id: `{!! $tag->name !!}`, label: `{!! $tag->name !!}` })
            @endforeach

        @endisset

        $('.bootstrap-tagsinput input').tagsinput({
            confirmKeys: [13, 44, 32]
        });

        $('span[data-role="remove"]').on('click', (e) => {
            let elem = document.getElementById('hiddenTagValue');
            let name = e.target.closest('.tag').innerText;
            console.log(name);
            tags = tags.filter((e) => e != name )
            oldTags = oldTags.filter((e) => e != name )
            document.getElementById('hiddenTagValue').value = oldTags.concat(tags).join(',');;
            console.log(document.getElementById('hiddenTagValue').value)
        });


        $('.bootstrap-tagsinput .bootstrap-tagsinput input').on('keyup', (e) => {
            if(e.keyCode == 32) {
                console.log('space');
                let items = document.querySelectorAll('.bootstrap-tagsinput .bootstrap-tagsinput > .tag');
                tags = [];
                for(let i of items) {
                    tags.push(i.innerText);
                }

                document.getElementById('hiddenTagValue').value = oldTags.concat(tags).join(',');
                console.log( document.getElementById('hiddenTagValue').value);
            }
        })

    }



</script>

@endsection
