<?php include APPPATH . 'views/header_view.php'; ?>
    <div id="content">
        <h1>Here is the information on the book that you have selected</h1>
        <?php             
            echo $bread;
            
            $cnt = 0;
            foreach( $book as $bookInfo ) {
                echo 'Title: ' . $bookInfo['title'] . '<br />'; 
                echo 'Author: ' . $bookInfo['author'] . '<br/>';
                echo 'Description: ' . $bookInfo['description'] . '<br/>';
                
                if($cnt == 0 || $cnt % 3) {
                    echo '<br />';
                } 
                $cnt++;
            }   

            echo $lex;
        ?>        
    </div>
<?php include APPPATH . 'views/footer_view.php'; 