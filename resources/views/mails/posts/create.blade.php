<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: lightcoral;
            text-align: center;
            padding: 15px 0;
        }

        main {
            background-color: whitesmoke;
            padding: 20px 20px 300px 20px;
        }

        p.mail-category {
            margin: 15px 0;
        }

    </style>

</head>
<body>

    <header>
        <div>
            <h2>Nuovo Post</h2>
        </div>
    </header>

    <main>
        <p>
            Ciao, hai creato "{{$post->title}}" !
        </p>

        <p class="mail-category">
            <strong>Categoria: </strong>
            
            @if ($post->Category)
            {{ $post->Category->label }}
           @else
            -
           @endif

        </p>

        <p>
            <strong>Tags: </strong>

            @forelse ($post->tags as $tag)

                    {{$tag->label}}
            
                    {{ $loop->last ? '' : ' - ' }}
            @empty
            -
            @endforelse

        </p>

    </main>
    
</body>
</html>