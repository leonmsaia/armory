<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">

    <!-- Breadcrumb y Título -->
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
          <li><a href="<?= site_url('armory') ?>">Armory</a></li>
          <li><span><?= $character->name ?></span></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= $character->name ?> (Nivel <?= $character->level ?>)</h1>
      </div>
    </div>

    <!-- Contenido -->
    <div class="uk-margin" uk-grid>
      <!-- Columna izquierda (info del personaje) -->
      <div class="uk-width-1-2@s">
        <div class="uk-card uk-card-default uk-card-body">
          <h3 class="uk-card-title"><i class="fa-solid fa-user"></i> Información del Personaje</h3>
          <ul class="uk-list uk-list-divider uk-margin-remove-top">
            <li><strong>Clase:</strong> <?= getClassName($character->class) ?></li>
            <li><strong>Raza:</strong> <?= getRaceName($character->race) ?></li>
            <li><strong>Género:</strong> <?= $character->gender == 0 ? 'Masculino' : 'Femenino' ?></li>
            <li><strong>Victorias PvP:</strong> <?= $character->totalKills ?></li>
            <li><strong>Oro:</strong> <?= floor($character->money / 10000) ?> 🪙</li>
          </ul>
        </div>
      </div>

      <!-- Columna derecha (equipo) -->
      <div class="uk-width-1-1@s uk-margin-top uk-margin-remove-bottom">
        <div class="uk-card uk-card-default uk-card-body">
          <h3 class="uk-card-title"><i class="fa-solid fa-shield-halved"></i> Equipo</h3>

          <?php if (empty($equipment)): ?>
            <p>No hay equipo equipado.</p>
          <?php else: ?>
            <div class="uk-overflow-auto">
              <table class="uk-table uk-table-divider uk-table-small uk-table-middle">
                <thead>
                  <tr>
                    <th>Slot</th>
                    <th>Ícono</th>
                    <th>Nombre</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($equipment as $item): ?>
                    <?php $itemData = get_item_data($item->itemEntry); ?>
                    <tr>
                      <td><?= getSlotName($item->slot) ?></td>
                      <td>
                        <img src="https://wow.zamimg.com/images/wow/icons/medium/<?= $itemData['icon'] ?>.jpg" width="32">
                      </td>
                      <td>
                        <a href="https://wowhead.com/item=<?= $item->itemEntry ?>"
                           data-wowhead="item=<?= $item->itemEntry ?>" target="_blank">
                          <?= $itemData['name'] ?>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>

          <p class="uk-margin-top">
            <a href="<?= base_url('armory') ?>" class="uk-button uk-button-default">
              <i class="fa fa-arrow-left"></i> Volver al Armory
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://wow.zamimg.com/widgets/power.js"></script>
