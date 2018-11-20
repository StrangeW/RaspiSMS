<?php
	//Template dashboard
	
	$this->render('incs/head', ['title' => 'Groupes - Show All'])
?>
<div id="wrapper">
<?php
	$this->render('incs/nav', ['page' => 'groupes'])
?>
	<div id="page-wrapper">
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Dashboard <small>Groupes</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							<i class="fa fa-dashboard"></i> <a href="<?php echo $this->generateUrl('Dashboard', 'show'); ?>">Dashboard</a>
						</li>
						<li class="active">
							<i class="fa fa-group"></i> Groupes
						</li>
					</ol>
				</div>
			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-group fa-fw"></i> Liste des groupes</h3>
						</div>
                        <div class="panel-body">
                            <form method="GET">
                                <?php if (!$groupes) { ?>
                                    <p>Aucun groupe n'a été formé pour le moment.</p>
                                <?php } else { ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped" id="table-groupes">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nom</th>
                                                    <th>Nombre de contacts</th>
                                                    <th style="width:5%;">Sélectionner</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach ($groupes as $groupe)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php $this->s($groupe['id']); ?></td>
                                                        <td><?php $this->s($groupe['name']); ?></td>
                                                        <td><?php $this->s($groupe['nb_contacts']); ?></td>
                                                        <td><input type="checkbox" name="ids[]" value="<?php $this->s($groupe['id']); ?>"></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                                <div>
                                    <div class="col-xs-6 no-padding">
                                        <a class="btn btn-success" href="<?php echo $this->generateUrl('Groupe', 'add'); ?>"><span class="fa fa-plus"></span> Ajouter un groupe</a>
                                    </div>
                                    <?php if ($groupes) { ?>
                                        <div class="text-right col-xs-6 no-padding">
                                            <strong>Action pour la séléction :</strong>
                                            <button class="btn btn-default" type="submit" formaction="<?php echo $this->generateUrl('Groupe', 'edit'); ?>"><span class="fa fa-edit"></span> Modifier</button>
                                            <button class="btn btn-default" type="submit" formaction="<?php echo $this->generateUrl('Groupe', 'delete', ['csrf' => $_SESSION['csrf']]); ?>"><span class="fa fa-trash-o"></span> Supprimer</button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function ()
	{
		jQuery('.action-dropdown a').on('click', function (e)
		{
			e.preventDefault();
			var target = jQuery(this).parents('.action-dropdown').attr('target');
			var url = jQuery(this).attr('href');
			jQuery(target).find('input:checked').each(function ()
			{
				url += '/' + jQuery(this).val();
			});
			window.location = url;
		});
	});
</script>
<?php
	$this->render('incs/footer');
