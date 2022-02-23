<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>英動詞変換器</h1>
        <form method="post">
            <input type="text" name="userInput">
            <input type="submit" value="変換する">
        </form>
    </header>

    <main>
    <?php

    const TYPE1 = ['visit', 'limit', 'play', 'enjoy', 'listen', 'see', 'dye', 'enter'];
    const TYPE2 = ['visit', 'limit', 'play', 'enjoy', 'listen', 'enter'];
    const TYPE3 = ['ir', 'er', 'ur'];
    const BOIN = ['a', 'i', 'u', 'e', 'o'];

    $moji = htmlspecialchars($_POST["userInput"], ENT_QUOTES);

    // 投稿されていて、かつ空文字でないとき
    if (isset($_POST["userInput"]) && (isset($_POST["userInput"]) && $_POST["userInput"] != "")) {

        // 現在分詞
        $prog = '';

        // 例外① 最後から2番目が母音でも、「ing」を付ける
        if (in_array($_POST["userInput"], TYPE1)) {
            $prog =  $_POST["userInput"] . "ing";

            // 例外② ieで終わる語はieを取ってyingにする
        } elseif ((substr($_POST["userInput"], -2) === "ie")) {
            $prog = substr($_POST["userInput"], 0, -2) . "ying";

            // 例外③ cで終わる語はkingにする
        } elseif ((substr($_POST["userInput"], -1) === "c")) {
            $prog = $_POST["userInput"] . "king";

            // 例外④ 「長母音 + 子音」は原型にingを付ける
        } elseif (in_array(substr($_POST["userInput"], -3, 1), BOIN)  && in_array(substr($_POST["userInput"], -2, 1), BOIN)) {
            $prog = $_POST["userInput"] . "ing";

            // 例外⑤ 「短母音 + 子音」は子音を重ねてingを付ける
        } elseif (in_array(substr($_POST["userInput"], -2, 1), BOIN)) {
            $prog = $_POST["userInput"] . substr($_POST["userInput"], -1) . "ing";

            // 通常の形
        } else {
            $prog = $_POST["userInput"] . "ing";
        }

        print("<span class='result'>現在分詞: " . $prog . "</span><br><br>");

        // 過去形
        $past = '';

        // 例外① 最後が母音+子音でも、「ed」を付ける
        if (in_array($_POST["userInput"], TYPE2)) {
            $past = $_POST["userInput"] . "ed";

            // 不規則動詞 'dye'
        } elseif ($_POST["userInput"] === "dye") {
            $past = $_POST["userInput"] . "d";

            // 不規則動詞 'get'
        } elseif ($_POST["userInput"] === "get") {
            $past = "got-got";

            // 不規則動詞 'run'
        } elseif ($_POST["userInput"] === "run") {
            $past = "ran-run";

            // 不規則動詞 'swim
        } elseif ($_POST["userInput"] === "swim") {
            $past = "swam-swumt";

            // 不規則動詞 'begin'
        } elseif ($_POST["userInput"] === "begin") {
            $past = "began-begun";

            // 不規則動詞 'read'
        } elseif ($_POST["userInput"] === "read") {
            $past = "read-read";

            // 'e'で終わる語は'd'を付ける
        } elseif (substr($_POST["userInput"], -1, 1) === "e") {
            $past = $_POST["userInput"] . "d";

            // 'p'で終わる語
        } elseif (substr($_POST["userInput"], -1, 1) === "p") {
            if (in_array(substr($_POST["userInput"], -2, 1), BOIN)) {
                $past = $_POST["userInput"] . "ped";
            } else {
                $past = $_POST["userInput"] . "ed";
            }

            // 'y'で終わる語
        } elseif (substr($_POST["userInput"], -1, 1) === "y") {
            if (in_array(substr($_POST["userInput"], -2, 1), BOIN)) {
                $past = $_POST["userInput"] . "ed";
            } else {
                $past = substr($_POST["userInput"], 0, strlen($_POST["userInput"] - 1)) . "ied";
            }

            // 'c'で終わる語は'k'を加えてから'ed'を付ける
        } elseif (substr($_POST["userInput"], -1, 1) === "c") {
            $past = $_POST["userInput"] . "ked";

            // 'or,er,ur'で終わる語は最後の子音を加えてから'ed'を加える
        } elseif (in_array(substr($_POST["userInput"], -2, 2), TYPE3)) {
            $past = $_POST["userInput"] . substr($_POST["userInput"], -1, 1) . "ed";

            // 例外④ 「長母音 + 子音」は原型に'ed'を付ける
        } elseif (isset($_POST["userInput"]) && in_array(substr($_POST["userInput"], -3, 1), BOIN)  && in_array(substr($_POST["userInput"], -2, 1), BOIN)) {
            $past = $_POST["userInput"] . "ed";

            // 例外⑤ 「短母音 + 子音」は子音を重ねて'ed'を付ける
        } elseif (isset($_POST["userInput"]) && in_array(substr($_POST["userInput"], -2, 1), BOIN)) {
            $past = $_POST["userInput"] . substr($_POST["userInput"], -1, 1) . "ed";

            // 通常の形
        } else {
            $past = $_POST["userInput"] . "ed";
        }

        print("<span class='result'>過去形: " . $past . "</span>");
    } else {
        print("入力してください");
    }

    // var_dump(substr($_POST["userInput"], -2, 1));

    ?>

    <img src="./images/dict.jpg" id="img1">
    <!-- <img src="./images/lib1.jpg" id="img2"> -->

    </main>
</body>

</html>
