
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>

<form class="g-3"
      id="updForm"
      action="{{ isset($question) ? '/questions/' . $question->id : '/questions'}}"
      method="post">
    @method(isset($question) ? 'PUT' : 'POST')
    @csrf
    {{--
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif
    --}}

    <div class="col-md-12 mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title"
               value="{{isset($question) ? $question->title : ''}}">
    </div>
    <div class="form-floating col-md-12">
        <textarea class="form-control editor__editable ck-editor__editable_inline" id="summary-ckeditor" name="summary-ckeditor" style="min-height: 400px;">
            {!! isset($question) ? $question->text  : '' !!}
        </textarea>
    </div>

    <button type="button" id="delete">Delete</button>

    @isset($question)
        @include('partial_view.tag.tagPanel', compact('question'))
    @endisset
    @empty($question)
        @include('partial_view.tag.tagPanel'))
    @endempty
    <div class="col-12">
        <button type="button" id="btn-submit" class="btn btn-primary">{{isset($question) ? 'Edit question' : 'Add question'}}</button>
    </div>

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
        document.getElementById('delete').addEventListener('click', _delete);

        // {{--filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",--}}
        // {{--    filebrowserUploadMethod: 'form'--}}
        // ClassicEditor.builtinPlugins = [
        //     ];
        // https://ckeditor.com/ckeditor-5/online-builder/
        // TODO: upload image
        // TODO: transform html text to show on the home page
        window.onbeforeunload = _delete;
    </script>
</form>

