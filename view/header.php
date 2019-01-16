<header>

    <nav class="site-nav">

        <div class="logo">
            <a href="https://www.pavelglac.com/"><i class="fab fa-css3 fa-lg"></i></a>
        </div>

        <div class="menu-toggle" onclick="toggle()">
            <div class="hamburger"></div>
        </div>
        <div class="menu">
            <ul class="open" id="ul">
                <li><a href="https://www.pavelglac.com/#about">O mně</a></li>
                <li><a href="https://www.pavelglac.com/#products">Produkty</a></li>
                <?php
                if (isset($_SESSION["user_id"])){?>
                <li><a href="logout.php">Odhlásit</a></li>
            </ul>
            <div class="basket"><a href="cart.php">
                    <i class="fas fa-lg fa-shopping-basket"></i>
                    <p class="only-pc">
                        <?php
                        require_once 'controllers/db_carts.php';
                        $itm = new db_carts();
                        $number = $itm->cart_number($_SESSION['user_id']);
                        if ($number == 0) echo "prázdný";
                        else{
                            if ($number == 1) echo "1 položka";
                            else{
                                if ($number < 5) echo "$number položky";
                                else echo "$number položek";
                            }
                        }
                        ?>
                    </p></a>
            </div>
        </div>
        <?php }
        else{?>
            <li><a href="login.php">Přihlásit</a></li>
            </ul>
            </div>
        <?php }?>



    </nav>
</header>