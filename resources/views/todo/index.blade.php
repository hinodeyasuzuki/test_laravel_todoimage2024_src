

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            TODO
        </h2>
    </x-slot>

    <div class="py-12">
        <table>
            <thead>
                <tr>
                    <th>タイトル</th>
                    <th>概要</th>
                    <th>日付</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                    <tr>
                        <td>{{ $todo->title }}</td>
                        <td>{!! $todo->description !!}</td>
                        <td>{{ $todo->created_at }}</td>
                        <td><form action="{{ route('todo.edit', ['todo' => $todo->id]) }}" method="get"><button type="submit">編集</button></form></td>
                        <td><form action="{{ route('todo.destroy', ['todo' => $todo->id]) }}" method="delete"><button type="submit">削除</button></form></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="button" href="{{ route('todo.create')}}">新規作成</a>
    </div>
</x-app-layout>

<style>
</style>
