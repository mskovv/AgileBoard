<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agile</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
    <header>
        <div class="title d-flex align-items-center justify-content-center mt-2">
            <span>AGILE BOARD</span>
        </div>
    </header>
    <main>
        <button class="btn btn-success mt-1 offset-1"><a href="#">Добавить cпринт</a></button>
        <div class="container-xl">

            <div class="card mt-3 bg-light">
                <div class="card-header text-center">
                    Неделя № 1
                </div>
                <div class="card-header"><button class="btn btn-success"><a href="#">Добавить задачу</a></button></div>
                <div class="card-body">
                    <div class="card-title text-white bg-secondary text-center">Task 1</div>
                    <div class="card-text bg-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti distinctio dolores dolorum, hic libero maxime nam nobis voluptatem. Assumenda cupiditate deserunt, fugiat ipsum nihil saepe ut! Blanditiis eius temporibus veritatis.</div>
                    <button class="btn btn-danger"><a href="#">Закончить задачу</a></button>
                </div>
                <div class="card-body">
                    <div class="card-title text-white bg-secondary text-center">Task 2</div>
                    <div class="card-text bg-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto delectus, dolorem mollitia obcaecati placeat quae.</div>
                    <button class="btn btn-danger"><a href="#">Закончить задачу</a></button>
                </div>
                <div class="card-footer">
                    <button class="btn btn-danger"><a href="#">Закончить спринт</a></button>
                </div>
            </div>

            <div class="card mt-3 bg-light">
                <div class="card-header text-center">
                    Неделя № 1
                </div>
                <div class="card-header"><button class="btn btn-success"><a href="#">Добавить задачу</a></button></div>
                <div class="card-body">
                    <div class="card-title text-white bg-secondary text-center">Task 1</div>
                    <div class="card-text bg-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti distinctio dolores dolorum, hic libero maxime nam nobis voluptatem. Assumenda cupiditate deserunt, fugiat ipsum nihil saepe ut! Blanditiis eius temporibus veritatis.</div>
                    <button class="btn btn-danger"><a href="#">Закончить задачу</a></button>
                </div>
                <div class="card-body">
                    <div class="card-title text-white bg-secondary text-center">Task 2</div>
                    <div class="card-text bg-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto delectus, dolorem mollitia obcaecati placeat quae.</div>
                    <button class="btn btn-danger"><a href="#">Закончить задачу</a></button>
                </div>
                <div class="card-footer">
                    <button class="btn btn-danger"><a href="#">Закончить спринт</a></button>
                </div>
            </div>


        </div>
    </main>

    </body>
</html>
