<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- チャート -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
</head>

<body>
    <?php
    require_once './../config/ini.php';

    use pokemon_lib\manager\PokemonSelect;

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $PokemonSelect = new PokemonSelect();

    $pokemon = $PokemonSelect->single($id);
    console($pokemon);
    ?>
    <canvas id="pokemonStatus"></canvas>
    <script>
        const ctx = document.getElementById("pokemonStatus");
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ["HP", "攻撃", "防御", "特攻", "特防", "素早さ"],
                datasets: [{
                    label: "<?= $pokemon['name']['ja'] ?>",
                    data: [
                        <?= $pokemon['status']['hp'] ?>,
                        <?= $pokemon['status']['attack'] ?>,
                        <?= $pokemon['status']['defense'] ?>,
                        <?= $pokemon['status']['special-attack'] ?>,
                        <?= $pokemon['status']['special-defense'] ?>,
                        <?= $pokemon['status']['speed'] ?>,
                    ],
                    backgroundColor: "rgba(67, 133, 215, 0.5)",
                    borderColor: "rgba(67, 133, 215, 1)",
                }]
            },
            options: {
                scales: {
                    r: {
                        max: 150, //グラフの最大値
                        min: 0, //グラフの最小値
                        ticks: {
                            stepSize: 50 //目盛間隔
                        }
                    }
                },
            }
        });
    </script>
</body>

</html>