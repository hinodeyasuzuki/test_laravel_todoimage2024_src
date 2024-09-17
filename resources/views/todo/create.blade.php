
<x-appedit-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            TODO作成
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('todo.store') }}" method="post">
            @csrf
        <table>
            <tr>
                <th>タイトル</th>
                <td><input type="text" name="title" value="{{ @$todo->title }}"></td>
            </tr>
            <tr>
                <th>概要</th>
                <td><textarea id="editor" name="description" >{{ @$todo->description }}</textarea></td>
            </tr>
        </table>
        <a href="{{ route('todo.index') }}" class="button">戻る</a>
        <button type="submit">作成</button>
        </form>
    </div>
</x-appedit-layout>