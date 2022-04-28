
 const {MyUploadAdapter} = require('./MyUploadAdapter');

function ClassicEditorCreate() {

    function MyCustomUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter(loader, uploadUlr);
        };
    }

    ClassicEditor
        .create(document.querySelector( '#summary-ckeditor'), {
            extraPlugins: [ MyCustomUploadAdapterPlugin ],
            alignment: {
                options: [ 'left', 'right', 'center' ]
            },
            toolbar: [
                'heading', '|', 'bulletedList', 'numberedList', 'alignment', 'undo', 'redo',
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'uploadImage'
            ],
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ],
            cloudServices: {
                uploadUrl: uploadUlr
            }

        } )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );

}

ClassicEditorCreate();
