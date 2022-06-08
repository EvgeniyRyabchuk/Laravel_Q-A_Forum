

<form class="g-3"
      id="updForm"
      action="{{
            isset($question) ?
                 route('questions.update', [app()->getLocale(), 'id' => $question->id])
            :
            route('questions.store', ["lang" => app()->getLocale()]) }}"
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
    {{-- Ckeditor --}}
    @isset($question)
        @include('.partial_view.ckeditor.ckeditor', ['text' => $question->text , 'isBeforeUnloadCheck' => 'true'] )
    @endisset
    @empty($question)
        @include('.partial_view.ckeditor.ckeditor', ['text' => '', 'isBeforeUnloadCheck' => 'true', ])
    @endempty


    {{-- Tags --}}
    @isset($question)
        @include('partial_view.tag.tagPanel', compact('question'))
    @endisset
    @empty($question)
        @include('partial_view.tag.tagPanel')
    @endempty

    <div class="col-12">
        <button type="button" id="btn-submit" class="btn btn-primary">{{isset($question) ? 'Edit question' : 'Add question'}}</button>
    </div>

</form>

