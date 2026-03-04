<?php

namespace App\Controllers;

use App\Models\Contrat;

class RapportController
{
    private Contrat $model;

    public function __construct()
    {
        $this->model = new Contrat();
    }

    private function loadTCPDF(): void
    {
        $tcpdfPath = __DIR__ . '/../../lib/tcpdf/tcpdf.php';
        if (!file_exists($tcpdfPath)) {
            die('<div style="color:red; padding:20px; font-family:Arial;">
                <h2>TCPDF non installé</h2>
                <p>Veuillez installer TCPDF dans <code>web/lib/tcpdf/</code></p>
                <p>Instructions dans <code>web/lib/README.md</code></p>
                <p>Ou lancer <code>web/lib/download_tcpdf.bat</code> (Windows) ou <code>web/lib/download_tcpdf.sh</code> (Linux/Mac)</p>
            </div>');
        }
        require_once $tcpdfPath;
    }

    /**
     * Génère le PDF d'un contrat (remplace Contrat.rpt / Contrat-2023.rpt)
     */
    public function imprimerContrat(int $id): void
    {
        $contrat = $this->model->getById($id);
        if (!$contrat) {
            http_response_code(404);
            exit('الملف غير موجود');
        }

        $this->loadTCPDF();

        $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('GcontratPN');
        $pdf->SetAuthor('Système de Gestion des Contrats');
        $pdf->SetTitle('Contrat N° ' . $contrat['Numero']);
        $pdf->SetSubject('Contrat');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->setRTL(true);
        $pdf->AddPage();

        $html = $this->buildContratHtml($contrat);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('contrat_' . $contrat['Numero'] . '.pdf', 'I');
        exit;
    }

    /**
     * Génère la liste des contrats en PDF (remplace ListeContrat.rpt)
     */
    public function listeContrats(array $filtres = []): void
    {
        $result   = $this->model->search($filtres, 1000, 0);
        $contrats = $result['data'];

        $this->loadTCPDF();

        $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('GcontratPN');
        $pdf->SetTitle('Liste des Contrats');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->setRTL(true);
        $pdf->AddPage();

        $html = $this->buildListeHtml($contrats);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('liste_contrats.pdf', 'I');
        exit;
    }

    /**
     * Génère les statistiques en PDF (remplace Stat-Contrat.rpt)
     */
    public function statistiques(string $annee = ''): void
    {
        $filtres = [];
        if ($annee !== '') {
            $filtres['AnneeExc'] = $annee;
        }
        $result   = $this->model->search($filtres, 1000, 0);
        $contrats = $result['data'];

        $this->loadTCPDF();

        $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('GcontratPN');
        $pdf->SetTitle('Statistiques des Contrats');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->setRTL(true);
        $pdf->AddPage();

        $html = $this->buildStatHtml($contrats, $annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('statistiques_contrats.pdf', 'I');
        exit;
    }

    private function buildContratHtml(array $c): string
    {
        $e = fn(mixed $v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
        $fmt = fn(?string $d) => $d ? date('d/m/Y', strtotime($d)) : '';

        return <<<HTML
<style>
body { font-family: dejavusans; font-size: 10pt; direction: rtl; text-align: right; }
h1 { font-size: 14pt; text-align: center; color: #2c3e50; border-bottom: 2px solid #2c3e50; padding-bottom: 5px; }
h3 { font-size: 11pt; color: #2980b9; border-bottom: 1px solid #2980b9; padding-bottom: 3px; margin-top: 15px; }
table { width: 100%; border-collapse: collapse; margin-top: 5px; }
td { padding: 5px 8px; border: 1px solid #ddd; font-size: 9pt; }
td.label { background-color: #ecf0f1; font-weight: bold; width: 35%; color: #2c3e50; }
.footer { text-align: center; margin-top: 20px; font-size: 9pt; color: #888; border-top: 1px solid #ddd; padding-top: 8px; }
</style>

<h1>GcontratPN - نظام إدارة العقود</h1>
<p style="text-align:center; color:#555; font-size:11pt;">بطاقة العقد رقم: {$e($c['Numero'])}</p>

<h3>البيانات الشخصية</h3>
<table>
<tr><td class="label">رقم العقد</td><td>{$e($c['Numero'])}</td><td class="label">الاسم</td><td>{$e($c['nom'])}</td></tr>
<tr><td class="label">رقم البطاقة الوطنية</td><td>{$e($c['CIN'])}</td><td class="label">الهاتف</td><td>{$e($c['Telephone'])}</td></tr>
<tr><td class="label">الرقم الجبائي</td><td>{$e($c['MatriculeFis'])}</td><td class="label">الاسم التجاري</td><td>{$e($c['NomCom'])}</td></tr>
<tr><td class="label">النشاط</td><td>{$e($c['LibAct'])}</td><td class="label">العنوان</td><td>{$e($c['LibAdr'])}</td></tr>
</table>

<h3>بيانات العقد</h3>
<table>
<tr><td class="label">تاريخ البداية</td><td>{$fmt($c['DateD'])}</td><td class="label">تاريخ التوقيع</td><td>{$fmt($c['DateSignature'])}</td></tr>
<tr><td class="label">موقّع</td><td>{$e($c['Signature'] ? 'نعم' : 'لا')}</td><td class="label">تاريخ الإرجاع</td><td>{$fmt($c['DateRetour'])}</td></tr>
<tr><td class="label">مُرجَع</td><td>{$e($c['Retour'] ? 'نعم' : 'لا')}</td><td class="label">رئيس المجلس</td><td>{$e($c['NomPresident'])}</td></tr>
</table>

<h3>التسجيل والتنفيذ</h3>
<table>
<tr><td class="label">تاريخ التسجيل</td><td>{$fmt($c['DateEnr'])}</td><td class="label">رقم التسجيل</td><td>{$e($c['NumeroEnr'])}</td></tr>
<tr><td class="label">مبلغ التسجيل</td><td>{$e($c['MontantEnr'])}</td><td class="label">صالح التسجيل</td><td>{$e($c['ValidEnr'] ? 'نعم' : 'لا')}</td></tr>
<tr><td class="label">سنة التنفيذ</td><td>{$e($c['AnneeExc'])}</td><td class="label">مبلغ التنفيذ</td><td>{$e($c['MontantExc'])}</td></tr>
<tr><td class="label">الكمية</td><td>{$e($c['Quantite'])}</td><td class="label">المبلغ السنوي</td><td>{$e($c['MontantAnn'])}</td></tr>
<tr><td class="label">عدد الأيام</td><td>{$e($c['NbrJour'])}</td><td class="label">المبلغ الحرفي</td><td>{$e($c['MontantLit'])}</td></tr>
<tr><td class="label">رقم الأمر</td><td>{$e($c['NumOrd'])}</td><td class="label">ملاحظات</td><td>{$e($c['observation'])}</td></tr>
</table>

<div class="footer">تم الطباعة في: {$e(date('d/m/Y H:i'))} — GcontratPN</div>
HTML;
    }

    private function buildListeHtml(array $contrats): string
    {
        $e   = fn(mixed $v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
        $fmt = fn(?string $d) => $d ? date('d/m/Y', strtotime($d)) : '';

        $rows = '';
        foreach ($contrats as $c) {
            $sig   = $c['Signature'] ? 'نعم' : 'لا';
            $ret   = $c['Retour']    ? 'نعم' : 'لا';
            $rows .= "<tr>
                <td>{$e($c['Numero'])}</td>
                <td>{$e($c['nom'])}</td>
                <td>{$e($c['CIN'])}</td>
                <td>{$fmt($c['DateD'])}</td>
                <td>$sig</td>
                <td>$ret</td>
                <td>{$e($c['LibAct'])}</td>
                <td>{$e($c['LibAdr'])}</td>
              </tr>";
        }

        return <<<HTML
<style>
body { font-family: dejavusans; font-size: 9pt; direction: rtl; text-align: right; }
h1 { font-size: 13pt; text-align: center; color: #2c3e50; }
table { width: 100%; border-collapse: collapse; margin-top: 10px; }
th { background-color: #2c3e50; color: white; padding: 5px; font-size: 9pt; }
td { padding: 4px 5px; border: 1px solid #ddd; font-size: 8pt; }
tr:nth-child(even) { background-color: #f5f5f5; }
.footer { text-align: center; margin-top: 15px; font-size: 8pt; color: #888; }
</style>
<h1>GcontratPN — قائمة العقود</h1>
<p style="text-align:center; color:#666; font-size:8pt;">عدد العقود: {$e(count($contrats))} — تاريخ الطباعة: {$e(date('d/m/Y'))}</p>
<table>
<thead>
<tr><th>رقم العقد</th><th>الاسم</th><th>ب.و.ت</th><th>تاريخ البداية</th><th>موقّع</th><th>مُرجَع</th><th>النشاط</th><th>العنوان</th></tr>
</thead>
<tbody>{$rows}</tbody>
</table>
<div class="footer">GcontratPN — نظام إدارة العقود</div>
HTML;
    }

    private function buildStatHtml(array $contrats, string $annee): string
    {
        $e     = fn(mixed $v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
        $total = count($contrats);
        $signes    = count(array_filter($contrats, fn($c) => $c['Signature']));
        $nonSignes = $total - $signes;
        $retours   = count(array_filter($contrats, fn($c) => $c['Retour']));
        $montantTotal = array_sum(array_column($contrats, 'MontantEnr'));

        return <<<HTML
<style>
body { font-family: dejavusans; font-size: 10pt; direction: rtl; text-align: right; }
h1 { font-size: 14pt; text-align: center; color: #2c3e50; border-bottom: 2px solid #2c3e50; padding-bottom: 5px; }
h3 { font-size: 11pt; color: #2980b9; margin-top: 20px; }
table { width: 60%; margin: 10px auto; border-collapse: collapse; }
td { padding: 8px 12px; border: 1px solid #ddd; font-size: 10pt; }
td.label { background-color: #ecf0f1; font-weight: bold; }
td.value { text-align: center; color: #2c3e50; font-size: 13pt; font-weight: bold; }
</style>
<h1>GcontratPN — إحصائيات العقود {$e($annee)}</h1>
<p style="text-align:center; color:#666; font-size:9pt;">تاريخ الطباعة: {$e(date('d/m/Y'))}</p>

<h3>الإحصائيات العامة</h3>
<table>
<tr><td class="label">إجمالي العقود</td><td class="value">{$e($total)}</td></tr>
<tr><td class="label">العقود الموقّعة</td><td class="value">{$e($signes)}</td></tr>
<tr><td class="label">غير موقّعة</td><td class="value">{$e($nonSignes)}</td></tr>
<tr><td class="label">المُرجَعة</td><td class="value">{$e($retours)}</td></tr>
<tr><td class="label">إجمالي المبالغ</td><td class="value">{$e(number_format($montantTotal, 3))}</td></tr>
</table>
HTML;
    }
}

