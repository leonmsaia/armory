<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">

    <!-- Breadcrumb y Título -->
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
          <li><span>Armory</span></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove">Listado de Personajes</h1>
      </div>
    </div>

    <!-- Contenido -->
    <div class="uk-card uk-card-default uk-card-body">
      <?php if (empty($characters)): ?>
        <p>No hay personajes para mostrar.</p>
      <?php else: ?>
        <div class="uk-overflow-auto">
          <table class="uk-table uk-table-divider uk-table-hover uk-table-small uk-table-middle">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Raza</th>
                <th>Clase</th>
                <th>Faccion</th>
                <th>Nivel</th>
                <th>Victorias PvP</th>
                <th>Oro</th>
                <th>Ver</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($characters as $char): ?>
                <tr>
                  <td class="uk-text-bold"><?= $char->name ?></td>
                  <td>
                     <?= getRaceName($char->race) ?>
                  </td>
                  <td>
                    <img src="<?= get_class_icon_url($char->class) ?>" width="36">
                  </td>
                  <td>
                    <img src="<?= get_faction_icon_url($char->race) ?>" width="36">
                  </td>
                  <td><?= $char->level ?></td>
                  <td><?= $char->totalKills ?></td>
                  <td><?= floor($char->money / 10000) ?> 🪙</td>
                  <td>
                    <a class="uk-button uk-button-small uk-button-default" href="<?= base_url('armory/view/' . $char->guid) ?>">
                      <i class="fa fa-eye"></i> Ver
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>
