



<style>
    .ck-editor__editable_inline {
        @isset($min_h)
            min-height: {{$min_h}}px;
        @endisset
        @empty($min_h)
           min-height: 400px;
        @endempty
    }
</style>

<div class="form-floating col-md-12">
        <textarea
            class="form-control editor__editable ck-editor__editable_inline"
            id="summary-ckeditor"
            name="summary-ckeditor"

        >
            {!! $text ?? '' !!}
        </textarea>
</div>
{{--<button type="button" id="delete">Delete</button>--}}

<script>
    var uploadUlr = "{{route('upload')}}";
</script>
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>--}}
<script src="/ckeditor/ckeditor.js"></script>
<script src="/js/ClassicEditorCreator.js"></script>
<script>
    //TODO: fix messy style
    var imagePathList = [];

    async function _delete() {
        console.log('delete');
        const body = JSON.stringify({
            'urlList': imagePathList
        });

        try {
            const data = await fetch('{{ url('ckeditor/remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'x-csrf-token': '{{csrf_token()}}'
                },
                body: body
            });
            const res = await data.json();
            console.log(res);
        } catch (err) {
            console.log(err);
        }
    }
    // document.getElementById('delete').addEventListener('click', _delete);

    // {{--filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",--}}
    // {{--    filebrowserUploadMethod: 'form'--}}
    // ClassicEditor.builtinPlugins = [
    //     ];
    // https://ckeditor.com/ckeditor-5/online-builder/

    // TODO: transform html text to show on the home page
    //TODO: check if imageList exist
    @isset($isBeforeUnloadCheck)
        @if($isBeforeUnloadCheck == 'true')
        window.addEventListener('load', () => {
            // document.getElementById('delete').addEventListener('click', _delete);
            window.onbeforeunload = _delete;
        })
        @endif
    @endisset



</script>
