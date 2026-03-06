<?php

namespace App\Controllers;

use App\Models\Contrat;
use Dompdf\Dompdf;
use Dompdf\Options;

class RapportController
{
    private Contrat $model;

    public function __construct()
    {
        $this->model = new Contrat();
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

        $html = $this->buildContratHtml($contrat);
        $this->renderPdf($html, 'contrat_' . $contrat['Numero'] . '.pdf');
    }

    /**
     * Génère la liste des contrats en PDF (remplace ListeContrat.rpt)
     */
    public function listeContrats(array $filtres = []): void
    {
        $result   = $this->model->search($filtres, 1000, 0);
        $contrats = $result['data'];
        $html     = $this->buildListeHtml($contrats);
        $this->renderPdf($html, 'liste_contrats.pdf');
    }

    /**
     * Affiche la page HTML des statistiques
     */
    public function statistiquesView(string $annee = ''): void
    {
        $statsArrond    = $this->model->statsByArrondissement($annee);
        $availableYears = $this->model->getAvailableYears();
        $loadCharts     = true;
        require __DIR__ . '/../Views/rapports/statistiques.php';
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
        $html     = $this->buildStatHtml($contrats, $annee);
        $this->renderPdf($html, 'statistiques_contrats.pdf');
    }

    private function buildContratHtml(array $c): string
    {
        $e = fn(mixed $v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
        $fmt = fn(?string $d) => $d ? date('d/m/Y', strtotime($d)) : '';

        return <<<HTML
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: DejaVu Sans, Arial, sans-serif; direction: rtl; font-size: 12px; color:#222; }
  .header { text-align:center; border-bottom:2px solid #2c3e50; padding-bottom:10px; margin-bottom:20px; }
  .header h1 { font-size:18px; color:#2c3e50; margin:0; }
  .header h2 { font-size:14px; color:#555; margin:5px 0 0; }
  table { width:100%; border-collapse:collapse; margin-bottom:15px; }
  th { background:#2c3e50; color:#fff; padding:6px 8px; text-align:right; }
  td { padding:6px 8px; border-bottom:1px solid #ddd; }
  .label { font-weight:bold; width:35%; color:#2c3e50; }
  .section-title { background:#eaf0fb; color:#2c3e50; font-weight:bold; padding:6px 8px;
                   border-right:4px solid #2c3e50; margin-top:15px; }
  .footer { text-align:center; margin-top:30px; font-size:10px; color:#888; border-top:1px solid #ddd; padding-top:8px; }
</style>
</head>
<body>
<div class="header">
  <h1>GcontratPN - نظام إدارة العقود</h1>
  <h2>بطاقة العقد رقم: {$e($c['Numero'])}</h2>
</div>

<div class="section-title">البيانات الشخصية</div>
<table>
  <tr><td class="label">رقم العقد</td><td>{$e($c['Numero'])}</td><td class="label">الاسم</td><td>{$e($c['nom'])}</td></tr>
  <tr><td class="label">رقم البطاقة الوطنية</td><td>{$e($c['CIN'])}</td><td class="label">الهاتف</td><td>{$e($c['Telephone'])}</td></tr>
  <tr><td class="label">الرقم الجبائي</td><td>{$e($c['MatriculeFis'])}</td><td class="label">الاسم التجاري</td><td>{$e($c['NomCom'])}</td></tr>
  <tr><td class="label">النشاط</td><td>{$e($c['LibAct'])}</td><td class="label">العنوان</td><td>{$e($c['LibAdr'])}</td></tr>
</table>

<div class="section-title">بيانات العقد</div>
<table>
  <tr><td class="label">تاريخ البداية</td><td>{$fmt($c['DateD'])}</td><td class="label">تاريخ التوقيع</td><td>{$fmt($c['DateSignature'])}</td></tr>
  <tr><td class="label">موقّع</td><td>{$e($c['Signature'] ? 'نعم' : 'لا')}</td><td class="label">تاريخ الإرجاع</td><td>{$fmt($c['DateRetour'])}</td></tr>
  <tr><td class="label">مُرجَع</td><td>{$e($c['Retour'] ? 'نعم' : 'لا')}</td><td class="label">رئيس المجلس</td><td>{$e($c['NomPresident'])}</td></tr>
</table>

<div class="section-title">التسجيل والتنفيذ</div>
<table>
  <tr><td class="label">تاريخ التسجيل</td><td>{$fmt($c['DateEnr'])}</td><td class="label">رقم التسجيل</td><td>{$e($c['NumeroEnr'])}</td></tr>
  <tr><td class="label">مبلغ التسجيل</td><td>{$e($c['MontantEnr'])}</td><td class="label">صالح التسجيل</td><td>{$e($c['ValidEnr'] ? 'نعم' : 'لا')}</td></tr>
  <tr><td class="label">سنة التنفيذ</td><td>{$e($c['AnneeExc'])}</td><td class="label">مبلغ التنفيذ</td><td>{$e($c['MontantExc'])}</td></tr>
  <tr><td class="label">الكمية</td><td>{$e($c['Quantite'])}</td><td class="label">المبلغ السنوي</td><td>{$e($c['MontantAnn'])}</td></tr>
  <tr><td class="label">عدد الأيام</td><td>{$e($c['NbrJour'])}</td><td class="label">المبلغ الحرفي</td><td>{$e($c['MontantLit'])}</td></tr>
  <tr><td class="label">رقم الأمر</td><td>{$e($c['NumOrd'])}</td><td class="label">ملاحظات</td><td>{$e($c['observation'])}</td></tr>
</table>

<div class="footer">
  تم الطباعة في: {$e(date('d/m/Y H:i'))} — GcontratPN
</div>
</body>
</html>
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
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: DejaVu Sans, Arial, sans-serif; direction:rtl; font-size:10px; }
  .header { text-align:center; margin-bottom:15px; border-bottom:2px solid #2c3e50; padding-bottom:8px; }
  h1 { font-size:15px; color:#2c3e50; }
  table { width:100%; border-collapse:collapse; }
  th { background:#2c3e50; color:#fff; padding:5px; font-size:10px; }
  td { padding:4px 5px; border-bottom:1px solid #ccc; }
  tr:nth-child(even) { background:#f5f7fa; }
  .footer { text-align:center; margin-top:20px; font-size:9px; color:#888; }
</style>
</head>
<body>
<div class="header">
  <h1>GcontratPN — قائمة العقود</h1>
  <p>عدد العقود: {$e(count($contrats))} — تاريخ الطباعة: {$e(date('d/m/Y'))}</p>
</div>
<table>
  <thead>
    <tr><th>رقم العقد</th><th>الاسم</th><th>ب.و.ت</th><th>تاريخ البداية</th><th>موقّع</th><th>مُرجَع</th><th>النشاط</th><th>العنوان</th></tr>
  </thead>
  <tbody>$rows</tbody>
</table>
<div class="footer">GcontratPN — نظام إدارة العقود</div>
</body>
</html>
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
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: DejaVu Sans, Arial, sans-serif; direction:rtl; font-size:12px; }
  .header { text-align:center; margin-bottom:20px; border-bottom:2px solid #2c3e50; }
  h1 { font-size:16px; color:#2c3e50; }
  .stat-box { display:inline-block; border:1px solid #2c3e50; padding:10px 20px;
              margin:5px; border-radius:4px; text-align:center; min-width:120px; }
  .stat-num { font-size:24px; color:#27ae60; font-weight:bold; }
  .stat-label { font-size:11px; color:#555; }
  table { width:100%; border-collapse:collapse; margin-top:20px; }
  th { background:#2c3e50; color:#fff; padding:6px; }
  td { padding:5px; border-bottom:1px solid #ddd; text-align:center; }
</style>
</head>
<body>
<div class="header">
  <h1>GcontratPN — إحصائيات العقود {$e($annee)}</h1>
  <p>تاريخ الطباعة: {$e(date('d/m/Y'))}</p>
</div>

<div style="text-align:center; margin:20px 0;">
  <div class="stat-box"><div class="stat-num">{$e($total)}</div><div class="stat-label">إجمالي العقود</div></div>
  <div class="stat-box"><div class="stat-num">{$e($signes)}</div><div class="stat-label">العقود الموقّعة</div></div>
  <div class="stat-box"><div class="stat-num">{$e($nonSignes)}</div><div class="stat-label">غير موقّعة</div></div>
  <div class="stat-box"><div class="stat-num">{$e($retours)}</div><div class="stat-label">المُرجَعة</div></div>
  <div class="stat-box"><div class="stat-num">{$e(number_format($montantTotal, 3))}</div><div class="stat-label">إجمالي المبالغ</div></div>
</div>
</body>
</html>
HTML;
    }

    private function renderPdf(string $html, string $filename): void
    {
        $options = new Options();
        $options->set('isRemoteEnabled', false);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => false]);
        exit;
    }
}
