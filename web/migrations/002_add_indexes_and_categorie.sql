-- GcontratPN — Migration 002
-- Ajout de la colonne categorie_id, index sur AnneeExc et created_at

ALTER TABLE `contrats` ADD COLUMN IF NOT EXISTS `categorie_id` INT UNSIGNED DEFAULT NULL;

ALTER TABLE `contrats`
    ADD CONSTRAINT `fk_contrats_categorie`
    FOREIGN KEY IF NOT EXISTS (`categorie_id`)
    REFERENCES `categories`(`id`)
    ON DELETE SET NULL ON UPDATE CASCADE;

CREATE INDEX IF NOT EXISTS `idx_contrats_annee`   ON `contrats`(`AnneeExc`);
CREATE INDEX IF NOT EXISTS `idx_contrats_created` ON `contrats`(`created_at`);
