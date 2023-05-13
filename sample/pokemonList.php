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
</head>

<body style="visibility:hidden" onLoad="document.body.style.visibility='visible'">
    <?php
    require_once './../config/ini.php';

    use pokemon_lib\manager\PokemonSelect;

    $PokemonSelect = new PokemonSelect();

    // $ids = range(1, 151);
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
                    <tr>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark text-end"><?= $pokemon['id']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark"><?= $pokemon['name']['ja']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark text-end"><?= $pokemon['status']['hp']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark text-end"><?= $pokemon['status']['attack']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark text-end"><?= $pokemon['status']['defense']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark text-end"><?= $pokemon['status']['special-attack']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark text-end"><?= $pokemon['status']['special-defense']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark text-end"><?= $pokemon['status']['speed']; ?></a></td>
                        <td class="text-nowrap align-middle p-0"><a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none p-2 text-dark text-end fw-bold"><?= $pokemon['status_total']; ?></a></td>
                        <td class="text-nowrap align-middle p-0">
                            <a href="<?= $link . $pokemon['id'] ?>" class="d-block text-decoration-none">
                                <img src="<?= $pokemon['imgs']['front_default']; ?>" alt="画像なし" style="max-height: 50px;">
                                <img src="<?= $pokemon['imgs']['back_default']; ?>" alt="画像なし" style="max-height: 50px;">
                                <img src="<?= $pokemon['imgs']['front_shiny']; ?>" alt="画像なし" style="max-height: 50px;">
                                <img src="<?= $pokemon['imgs']['back_shiny']; ?>" alt="画像なし" style="max-height: 50px;">
                            </a>
                        </td>
                    </tr>
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