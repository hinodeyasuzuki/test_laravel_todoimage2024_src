@push('head')
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "../../assets/vendor/ckeditor5.js",
            "ckeditor5/": "../../assets/vendor/"
        }
    }
</script>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            TODO編集
        </h2>
        <link rel="stylesheet" href="../../assets/vendor/ckeditor5.css">

    </x-slot>

    <div class="py-12">
        <form action="{{ route('todo.update', ['todo' => $todo->id]) }}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <th>タイトル</th>
                    <td><input type="text" name="title" value="{{ $todo->title }}"></td>
                </tr>
                <tr>
                    <th>概要</th>
                    <td>
                        <textarea id="editor" name="description">{{ $todo->description }}</textarea>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="id" value="{{ $todo->id }}">
            <a href="{{ route('todo.index') }}" class="button">戻る</a>
            <button type="submit">更新</button>
        </form>
    </div>


    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Heading,
            Bold,
            Italic,
            Font,
            Image,
            ImageCaption,
            ImageResize,
            ImageStyle,
            ImageToolbar,
            ImageUpload,
            Link,
            List,
            ListProperties,
            Table,
            TableColumnResize,
	TableToolbar,
            Indent,
            IndentBlock,
            SimpleUploadAdapter
        } from 'ckeditor5';


        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [
                    SimpleUploadAdapter,
                    Essentials,
                    Paragraph, Heading, Bold, Italic,
                    Font,
                    Image, ImageUpload,ImageCaption,ImageResize,ImageStyle,ImageToolbar,

                    Link, Indent, IndentBlock, 
                    List, ListProperties, 
                    Table,	TableColumnResize, TableToolbar,

                ],
                toolbar: [
                    'undo', 'redo', '|', 'heading', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                    '|',
                    'link', 'insertImage', 'insertTable',
                    '|',
                    'bulletedList', 'numberedList', 'outdent', 'indent'

                ],

                heading: {
                    options: [{
                            model: 'paragraph',
                            title: '本文',
                            class: 'ck-heading_paragraph',
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'H1',
                            class: 'ck-heading_heading1',
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'H2',
                            class: 'ck-heading_heading2',
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'H3',
                            class: 'ck-heading_heading3',
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'H4',
                            class: 'ck-heading_heading4',
                        },
                    ],
                },
                fontFamily: {
                    supportAllValues: true,
                },
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'toggleImageCaption',
                        '|',
                        'imageStyle:inline',
                        'imageStyle:wrapText',
                        'imageStyle:breakText',
                    ],
                },

                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableProperties',
                        'tableCellProperties',
                        'toggleTableCaption',
                    ],
                },


                simpleUpload: {
                    // The URL that the images are uploaded to.
                    uploadUrl: '{{ route("todo.imgupload") }}',

                    // Enable the XMLHttpRequest.withCredentials property.
                    withCredentials: true,

                    // Headers sent along with the XMLHttpRequest to the upload server.
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>


</x-app-layout>