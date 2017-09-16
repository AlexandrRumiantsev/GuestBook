	
		<div class="panel panel-default popular-products">
		  <div class="panel-heading">
			<h3 class="panel-title">Результаты поиска: <b><?php echo $s; ?></b></h3>
		  </div>
		  <div class="panel-body">
			<?php
			if (count($products)) { 
				foreach ($products as $row) { ?>
				<div class="popular-item col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<h4><a href="product.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h4>
					<a href="product.php?id=<?php echo $row['id']; ?>"><img src="/images/<?php echo $row['id']; ?>.jpg" /></a>
					<span><?php echo $row['price']; ?> руб.</span>
					<a class="btn btn-primary" href="cart.php?id=<?php echo $row['id']; ?>">В корзину</a>
				</div>
				<?php }
			} else { ?>
				<p>Не найдено ни одного товара!</p>
			<?php } ?>
		  </div>
		</div>
<?php

// выводим код подвала
include_once('footer.php');