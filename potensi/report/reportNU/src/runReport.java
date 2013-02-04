


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author ade
 */
public class runReport {

    static boolean debugging = true;

    public static void main(String args[]) {
        //[pdf/printlangusng] [filereport] [filepdf] [kondisi]
        
        
        String direktoryReport = "/media/apps/pakedy/depak/potensi/report/";
        if (!debugging) {
            direktoryReport = "";
        }
        String fileReport ="",qryData ="",thisCondition="",pdfDestination="";
        java.util.Map parameter = new java.util.HashMap();
        
        fileReport = direktoryReport + "newaasetLaporan.jasper";
        qryData = "select id,jenis_aset,ket_jenis,nama_aset,lokasi,ranting,kecid"
                + ",(select b.namaKelurahan from tbkelurahan b where b.kelurahanID=kelid) as namaKabupaten"
                + ",(select a.namaKecamatan from tbkecamatan a where a.kecamatanID=kecid) as namaKecamatan"
                + "  from newaset"+thisCondition+" order by kecid,id";
        
        String klaSS = "jdbc:mysql://localhost/potensi?user=nujatim&password=klaser";
        try {
            Class.forName("com.mysql.jdbc.Driver").newInstance();
            java.sql.Connection conec = java.sql.DriverManager.getConnection(klaSS);
            parameter.put("qryData", qryData);
            net.sf.jasperreports.engine.JasperPrint jasperPrint = net.sf.jasperreports.engine.JasperFillManager.fillReport(fileReport, parameter, conec);
            net.sf.jasperreports.view.JasperViewer jasperViewer = new net.sf.jasperreports.view.JasperViewer(jasperPrint, false);
            jasperViewer.setDefaultCloseOperation(javax.swing.JFrame.HIDE_ON_CLOSE);
            jasperViewer.setExtendedState(javax.swing.JFrame.MAXIMIZED_BOTH);
            jasperViewer.setTitle("Laporan Aset");
            if (debugging) {
                jasperViewer.setVisible(true);
            }
            //export to pdf
            pdfDestination = direktoryReport+"peka.pdf";
            net.sf.jasperreports.engine.JasperExportManager.exportReportToPdfFile(jasperPrint, pdfDestination);
            //end export to pdf
            
            //print report
            net.sf.jasperreports.engine.JasperPrintManager.printReport(jasperPrint, false);
            //end printreport
        } catch (Exception ex) {
            if (debugging) {
                System.out.println(" error " + ex.getMessage());
            }
        }
    }
}
