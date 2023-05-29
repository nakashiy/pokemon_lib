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
    <!-- データテーブル -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <!-- チャート -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
</head>

<body style="visibility:hidden" onLoad="document.body.style.visibility='visible'">
    <?php
    require_once './../config/ini.php';

    use pokemon_lib\manager\PokemonSelect;

    $PokemonSelect = new PokemonSelect();

    $ids = range(1, 10);
    // $pokemons = $PokemonSelect->multi($ids);
    $pokemons = $PokemonSelect->all();
    console($pokemons);
    $link = '/pokemon_lib/sample/pokemon.php?id=';
    ?>
    <div class="container py-4">
        <table id="pokemon" class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th class="text-nowrap">ID</th>
                    <th class="text-nowrap">名前</th>
                    <th class="text-nowrap">HP</th>
                    <th class="text-nowrap">攻撃</th>
                    <th class="text-nowrap">防御</th>
                    <th class="text-nowrap">特攻</th>
                    <th class="text-nowrap">特防</th>
                    <th class="text-nowrap">素早さ</th>
                    <th class="text-nowrap">合計</th>
                    <th class="text-nowrap">画像</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pokemons as $pokemon) : ?>
                    <!-- リスト -->
                    <tr>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark text-end" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['id']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['name']['ja']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark text-end" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['status']['hp']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark text-end" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['status']['attack']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark text-end" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['status']['defense']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark text-end" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['status']['special-attack']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark text-end" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['status']['special-defense']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark text-end" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['status']['speed']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="" class="d-block text-decoration-none p-2 text-dark text-end fw-bold" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>"><?= $pokemon['status_total']; ?></a></td>
                        <td class="text-nowrap align-middle p-0">
                            <a href="" class="d-block text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal<?= $pokemon['id'] ?>">
                                <img src="<?= $pokemon['imgs']['front_default']; ?>" alt="画像なし" style="max-height: 50px;">
                                <!-- <img src="<?= $pokemon['imgs']['back_default']; ?>" alt="画像なし" style="max-height: 50px;">
                                <img src="<?= $pokemon['imgs']['front_shiny']; ?>" alt="画像なし" style="max-height: 50px;">
                                <img src="<?= $pokemon['imgs']['back_shiny']; ?>" alt="画像なし" style="max-height: 50px;"> -->
                            </a>
                        </td>
                    </tr>
                    <?php if (false) : ?>
                        <!-- モーダル -->
                        <div id="modal<?= $pokemon['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal<?= $pokemon['id'] ?>-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header px-0 bg-dark">
                                        <img class="d-block w-50 m-auto" src="<?= $pokemon['imgs']['other']['official-artwork']['front_default'] ?>" class="img-fluid">
                                    </div>
                                    <div class="modal-body">
                                        <!-- チャート -->
                                        <canvas id="pokemonStatus<?= $pokemon['id'] ?>"></canvas>
                                        <script>
                                            const ctx<?= $pokemon['id'] ?> = document.getElementById("pokemonStatus<?= $pokemon['id'] ?>");
                                            new Chart(ctx<?= $pokemon['id'] ?>, {
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        $.extend($.fn.dataTable.defaults, {
            language: {
                url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
            }
        });
        $("#pokemon").DataTable({
            // lengthChange: false, // 件数切替機能
            // searching: false, // 検索機能
            // ordering: false, // ソート機能
            // order: [],
            // info: false, // 情報表示
            // paging: false, // ページング機能
            // destroy: true,
            // retrieve: true,
        });
    </script>
</body>

</html>