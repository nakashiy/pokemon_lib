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

<body>
    <?php
    require_once './../config/ini.php';

    use pokemon_lib\manager\PokemonSelect;

    $PokemonSelect = new PokemonSelect();

    $ids = range(1, 151);
    // $pokemons = $PokemonSelect->multi($ids);
    $pokemons = $PokemonSelect->all();
    console($pokemons);
    ?>
    <div class="container py-4">
        <table id="pokemon" class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th class="text-nowrap">ID</th>
                    <th class="text-nowrap">名前</th>
                    <th class="text-nowrap">画像</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pokemons as $pokemon) : ?>
                    <tr>
                        <td class="text-nowrap"><a href="#"><?= $pokemon['id']; ?></a></td>
                        <td class="text-nowrap"><a href="#"><?= $pokemon['name']['ja']; ?></a></td>
                        <td class="text-nowrap"><a href="#"><img src="<?= $pokemon['img_url']; ?>" style="max-height: 50px;"></a></td>
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