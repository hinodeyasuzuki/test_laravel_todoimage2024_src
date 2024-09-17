<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "../../assets/vendor/ckeditor5.js",
                "ckeditor5/": "../../assets/vendor/"
            }
        }
    </script>
    @stack('head')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
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
                    Image, ImageUpload, ImageCaption, ImageResize, ImageStyle, ImageToolbar,

                    Link, Indent, IndentBlock,
                    List, ListProperties,
                    Table, TableColumnResize, TableToolbar,

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

</body>

</html>