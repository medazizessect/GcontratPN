# Librairies tierces

## TCPDF (Génération PDF)

TCPDF est utilisé pour la génération de PDFs avec support RTL (arabe).

### Installation

#### Option 1 — Windows (XAMPP)
Exécuter le script : `download_tcpdf.bat`

#### Option 2 — Linux/Mac
```bash
chmod +x download_tcpdf.sh
./download_tcpdf.sh
```

#### Option 3 — Manuel
1. Télécharger TCPDF depuis https://github.com/tecnickcom/TCPDF/releases/tag/6.7.5
2. Extraire et copier le contenu dans `web/lib/tcpdf/`
3. Vérifier que `web/lib/tcpdf/tcpdf.php` existe

### Vérification
Accéder à `http://localhost/GcontratP/web/?page=rapports&action=imprimer_contrat&id=1`
