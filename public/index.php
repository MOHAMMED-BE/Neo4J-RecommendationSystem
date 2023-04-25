<?php

require_once('Connect.php');
session_start();

include("layout.php");
include("header.php");

?>

<body id="body">

    <section class="container">


        <section class="d-flex justify-content-evenly flex-wrap">
            <section style='
        width: 100% !important;
        height: 0vh !important;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 6rem;'>


                <div class='section-header'>

                    <h2 class='section-title'>All Articles</h2>
                    <span class='line'></span>

                </div>
            </section>

            <?php
            $getArticls = $client->run(
                'MATCH (AuthorNode:Author)-[:Publish]->(PaperNode:Paper) where PaperNode.idPaper <>"null" RETURN PaperNode,AuthorNode'
            );

            echo "<section class='container mt-3 d-flex justify-content-evenly flex-wrap' >";

            foreach ($getArticls as $values) {

                $AuthorNode = $values->get('AuthorNode');
                $PaperNode = $values->get('PaperNode');

                echo "<article class='mt-4 size' >
            <a href=''>" . "<img class='rounded' src='" . "../images/" . $PaperNode->getProperty('image') . "' width='100' height='100' />" .
                    "  </a>
                <p>" . $PaperNode->getProperty('title') . "</p>
                <span>"  .  "<span style='color:black;'>by </span>" . $AuthorNode->getProperty('fullName') . "</span>
        </article>";
            }

            echo "</section>";

            ?>

        </section>


    </section>

    <script src="js/script.js"></script>
</body>

</html>