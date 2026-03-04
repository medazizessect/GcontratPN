<?php
// web/app/Controllers/RapportController.php
// Aucun namespace, aucun Composer — require_once direct vers TCPDF

class RapportController
{
    private function loadTCPDF(): void
    {
        $path = __DIR__ . '/../../lib/tcpdf/tcpdf.php';
        if (!file_exists($path)) {
            http_response_code(500);
            echo '<!DOCTYPE html><html lang="ar" dir="rtl"><head>
                <meta charset="UTF-8">
                <title>TCPDF manquant</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
            </head><body class="p-4">
            <div class="alert alert-danger">
                <h4>⚠️ TCPDF non installé</h4>
                <p>Veuillez placer les fichiers TCPDF dans : <code>web/lib/tcpdf/</code></p>
                <p>Télécharger depuis : <a href="https://github.com/tecnickcom/TCPDF/releases" target="_blank">https://github.com/tecnickcom/TCPDF/releases</a></p>
                <ol>
                    <li>Télécharger la dernière version zip</li>
                    <li>Extraire et copier le contenu dans <code>web/lib/tcpdf/</code></li>
                    <li>Vérifier que <code>web/lib/tcpdf/tcpdf.php</code> existe</li>
                </ol>
                <a href="javascript:history.back()" class="btn btn-secondary">← Retour</a>
            </div>
            </body></html>';
            exit;
        }
        require_once $path;
    }

    public function imprimerContrat(?int $id): void
    {
        if (!$id) { http_response_code(400); echo "معرف مفقود"; return; }

        $this->loadTCPDF();

        $contratModel = new Contrat();
        $contrat = $contratModel->getById($id);
        if (!$contrat) { http_response_code(404); echo "العقد غير موجود"; return; }

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('GcontratPN');
        $pdf->SetAuthor('Système de Gestion des Contrats');
        $pdf->SetTitle('Contrat N° ' . ($contrat['Numero'] ?? ''));
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->setRTL(true);
        $pdf->AddPage();

        $html = $this->buildContratHtml($contrat);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('contrat_' . ($contrat['Numero'] ?? $id) . '.pdf', 'I');
    }

    public function listeContrats(): void
    {
        $this->loadTCPDF();

        $contrats = (new Contrat())->getAll();

        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('GcontratPN');
        $pdf->SetTitle('Liste des Contrats');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->setRTL(true);
        $pdf->AddPage();

        $pdf->writeHTML($this->buildListeHtml($contrats), true, false, true, false, '');
        $pdf->Output('liste_contrats.pdf', 'I');
    }

    public function statistiques(): void
    {
        $this->loadTCPDF();

        $m = new Contrat();
        $signed = $m->countBySigned();
        $stats = [
            'total'    => $m->countAll(),
            'signes'   => (int)($signed['signes'] ?? 0),
            'ce_mois'  => $m->countThisMonth(),
        ];

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('GcontratPN');
        $pdf->SetTitle('Statistiques des Contrats');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->setRTL(true);
        $pdf->AddPage();

        $pdf->writeHTML($this->buildStatsHtml($stats), true, false, true, false, '');
        $pdf->Output('statistiques.pdf', 'I');
    }

    private function buildContratHtml(array $c): string
    {
        $e = fn($v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
        $fmt = fn($v) => number_format((float)($v ?? 0), 3, '.', ' ');
        $date = date('d/m/Y');

        return <<<HTML
<style>
body{font-family:dejavusans,sans-serif;font-size:10pt;direction:rtl;text-align:right}
h1{font-size:14pt;text-align:center;color:#2c3e50;border-bottom:2px solid #2c3e50;padding-bottom:5px}
h3{font-size:11pt;color:#2980b9;border-bottom:1px solid #2980b9;padding-bottom:3px;margin-top:15px}
table{width:100%;border-collapse:collapse;margin-top:5px}
td{padding:5px 8px;border:1px solid #ddd;font-size:9pt}
.lb{background:#ecf0f1;font-weight:bold;width:40%}
</style>
<h1>عقد رقم: {$e($c['Numero'])}</h1>
<p style="text-align:center;color:#666;font-size:9pt">تاريخ الطباعة: {$date}</p>

<h3>معلومات المتعاقد</h3>
<table>
<tr><td class="lb">الاسم واللقب</td><td>{$e($c['nom'])}</td></tr>
<tr><td class="lb">رقم بطاقة الهوية</td><td>{$e($c['CIN'])}</td></tr>
<tr><td class="lb">الهاتف</td><td>{$e($c['Telephone'])}</td></tr>
<tr><td class="lb">المعرف الجبائي</td><td>{$e($c['MatriculeFis'])}</td></tr>
<tr><td class="lb">الاسم التجاري</td><td>{$e($c['NomCom'])}</td></tr>
</table>

<h3>بيانات العقد</h3>
<table>
<tr><td class="lb">تاريخ البداية</td><td>{$e($c['DateD'])}</td></tr>
<tr><td class="lb">تاريخ التوقيع</td><td>{$e($c['DateSignature'])}</td></tr>
<tr><td class="lb">عدد الأيام</td><td>{$e($c['NbrJour'])}</td></tr>
</table>

<h3>التسجيل والمبالغ</h3>
<table>
<tr><td class="lb">تاريخ التسجيل</td><td>{$e($c['DateEnr'])}</td></tr>
<tr><td class="lb">رقم التسجيل</td><td>{$e($c['NumeroEnr'])}</td></tr>
<tr><td class="lb">مبلغ التسجيل</td><td>{$fmt($c['MontantEnr'])} د.ت</td></tr>
<tr><td class="lb">سنة التنفيذ</td><td>{$e($c['AnneeExc'])}</td></tr>
<tr><td class="lb">مبلغ التنفيذ</td><td>{$fmt($c['MontantExc'])} د.ت</td></tr>
<tr><td class="lb">المبلغ السنوي</td><td>{$fmt($c['MontantAnn'])} د.ت</td></tr>
</table>

<h3>ملاحظات</h3>
<p>{$e($c['observation'])}</p>

<br/><br/>
<table><tr>
<td style="text-align:center;border:none;width:50%"><p>إمضاء المتعاقد</p><br/><br/><p>________________</p><p>{$e($c['nom'])}</p></td>
<td style="text-align:center;border:none;width:50%"><p>الرئيس المدير العام</p><br/><br/><p>________________</p><p>{$e($c['NomPresident'])}</p></td>
</tr></table>
HTML;
    }

    private function buildListeHtml(array $contrats): string
    {
        $date = date('d/m/Y');
        $rows = '';
        foreach ($contrats as $c) {
            $e = fn($v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
            $rows .= '<tr>'
                . '<td>' . $e($c['Numero'])        . '</td>'
                . '<td>' . $e($c['nom'])            . '</td>'
                . '<td>' . $e($c['CIN'])            . '</td>'
                . '<td>' . $e($c['Telephone'])      . '</td>'
                . '<td>' . $e($c['DateD'])          . '</td>'
                . '<td>' . $e($c['DateSignature'])  . '</td>'
                . '<td>' . ($c['Signature'] ? '✓' : '✗') . '</td>'
                . '<td>' . number_format((float)($c['MontantAnn'] ?? 0), 3, '.', ' ') . '</td>'
                . '</tr>';
        }
        return <<<HTML
<style>
body{font-family:dejavusans,sans-serif;font-size:9pt;direction:rtl;text-align:right}
h1{font-size:13pt;text-align:center;color:#2c3e50}
table{width:100%;border-collapse:collapse;margin-top:10px}
th{background:#2c3e50;color:white;padding:5px;font-size:9pt}
td{padding:4px 5px;border:1px solid #ddd;font-size:8pt}
tr:nth-child(even){background:#f5f5f5}
</style>
<h1>قائمة العقود</h1>
<p style="text-align:center;color:#666;font-size:8pt">تاريخ الطباعة: {$date}</p>
<table>
<tr><th>رقم العقد</th><th>الاسم</th><th>ب.ت.و</th><th>الهاتف</th><th>تاريخ البداية</th><th>تاريخ التوقيع</th><th>موقّع</th><th>المبلغ السنوي</th></tr>
{$rows}
</table>
HTML;
    }

    private function buildStatsHtml(array $stats): string
    {
        $date = date('d/m/Y');
        $total    = $stats['total'];
        $signes   = $stats['signes'];
        $nonSign  = $total - $signes;
        $ceMois   = $stats['ce_mois'];
        $taux     = $total > 0 ? round(($signes / $total) * 100, 1) : 0;

        return <<<HTML
<style>
body{font-family:dejavusans,sans-serif;font-size:10pt;direction:rtl;text-align:right}
h1{font-size:14pt;text-align:center;color:#2c3e50;border-bottom:2px solid #2c3e50;padding-bottom:5px}
table{width:60%;margin:10px auto;border-collapse:collapse}
td{padding:8px 12px;border:1px solid #ddd}
.lb{background:#ecf0f1;font-weight:bold}
.val{text-align:center;color:#2c3e50;font-size:13pt;font-weight:bold}
</style>
<h1>إحصائيات العقود</h1>
<p style="text-align:center;color:#666;font-size:9pt">تاريخ الطباعة: {$date}</p>
<table>
<tr><td class="lb">إجمالي العقود</td><td class="val">{$total}</td></tr>
<tr><td class="lb">العقود الموقعة</td><td class="val">{$signes}</td></tr>
<tr><td class="lb">العقود غير الموقعة</td><td class="val">{$nonSign}</td></tr>
<tr><td class="lb">عقود هذا الشهر</td><td class="val">{$ceMois}</td></tr>
<tr><td class="lb">نسبة التوقيع</td><td class="val">{$taux}%</td></tr>
</table>
HTML;
    }
}
