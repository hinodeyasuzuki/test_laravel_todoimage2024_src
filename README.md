

■インストールのしかた

docker compose exec php bash
　　（中に入って処理をする）

composer create-project laravel/laravel src
 　外部発信のために srcを共通としている（Dockerの親で名前を指定）


（設定ずみ）
download ckeditor  https://ckeditor.com/ckeditor-5/download/#zip => public/assets/vendor/


php artisan storage:link


（配慮点）
通常に画像送信すると @csrf　がないためにエラー
　                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }

