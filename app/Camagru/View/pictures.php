<section class="section hero has-text-centered is-dark  is-bold">

    <div class="container">
        <h1 class="title">Gallery:</h1>
		<?php foreach (array_reverse($pictures) as $img) /** @var \Camagru\Model\Picture $img */ { ?>
			<?php $author = $img->getUser() ?>
            <div class="box has-background-dark">
                <section
                        class="section hero has-text-centered is-dark  is-bold">
                    <div id=<?= "picture_" . $img->getId() ?>>
                        <h1 class="subtitle is-success"> <?= $author->getUsername() ?>
                            Uploaded: </h1>
                        <img src=<?= "/public/image/" . $img->getName(); ?>>
                        <p><?= count($img->getLikes()) ?> <i
                                    class="fas fa-heart"></i></p>
						<?php if (array_key_exists("login", $_SESSION)) { ?>
							<?php if ($author->getUsername() === $_SESSION["login"]) { ?>
                                <div class="field is-grouped is-grouped-centered">
                                <p class="control">
							<?php } ?>
                            <form name="likes" method="post" action="/picture/like">
                                <input type="hidden" name="picture_id"
                                       value=<?= $img->getId() ?>>
                                <input class="button is-warning" type="submit"
                                       value="Like">
                            </form>
                            </p>
							<?php if ($author->getUsername() === $_SESSION["login"]) { ?>
                                <p class="contol">
                                <form action="/picture/delete" method="POST">
                                    <input type="hidden" name="img_id"
                                           value=<?= $img->getId() ?>>
                                    <input class="button is-danger"
                                           type="submit" name="delete"
                                           value="Delete picture">
                                </form>
								<?php if ($author->getUsername() === $_SESSION["login"]) { ?>
                                    </p>
                                    </div>
								<?php } ?>

							<?php } ?>
							<?php $comments = $img->getComments() ?>
                            <div class="box has-background-dark has-text-light is-bold"
                                 style="overflow: auto; height: 100px">
								<?php foreach ($comments as $comment) { ?>
                                    <p><?= $comment->getUser()->getUsername() ?>
                                        : <?= $comment->getData() ?></p>
								<?php } ?>
                            </div>

                            <form method="post" action="/picture/comment">
                                <input type="hidden" name="picture_id"
                                       value=<?= $img->getId() ?>>
                                <input type="hidden" name="author_id"
                                       value=<?= $author->getId() ?>>
                                <div class="field has-addons">
                                    <div class="control is-expanded">
                                        <input class="input" type="text"
                                               name="comment"
                                               placeholder="Comment" required>
                                    </div>
                                    <div class="control">
                                        <input class="button is-warning"
                                               type="submit" value="Comment">
                                    </div>
                                </div>
                            </form>

						<?php } ?>
                    </div>
                </section>
            </div>
		<?php } ?>
    </div>

</section>