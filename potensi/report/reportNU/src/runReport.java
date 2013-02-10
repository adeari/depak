

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author ade
 */
public class runReport {

    static boolean debugging = false;

    public static void main(String args[]) {
        //[pdf/printlangusng] [directoryREPORT] [directoryPDF] [filereport] [filepdf] [kondisi]
// path di pak edy "F:/SERVERLAMA/wamp/www/potensi/dist/logoNU.png"

        String direktoryReport = "/media/apps/pakedy/depak/potensi/dist/";
        String directoyPDF = "/media/apps/pakedy/depak/potensi/pdf/";
        if (!debugging) {
            direktoryReport = args[1];
            directoyPDF = args[2];
        }

        String fileReport = "", qryData = "", thisCondition = "", pdfDestination = "";
        java.util.Map parameter = new java.util.HashMap();

        fileReport = direktoryReport + args[3] + ".jasper";
        try {
            if (args[5] != null) {
                if (args[5].length() > 0) {
                    thisCondition += " propid = " + args[5] + " ";
                }
            }
        } catch (Exception ex) {
        }

        try {
            if (args[6] != null) {
                if (args[6].length() > 0) {
                    if (thisCondition.length() > 0) {
                        thisCondition += " and ";
                    }
                    thisCondition += " kabid = " + args[6] + " ";
                }
            }
        } catch (Exception ex) {
        }

        try {
            if (args[7] != null) {
                if (args[7].length() > 0) {
                    if (thisCondition.length() > 0) {
                        thisCondition += " and ";
                    }
                    thisCondition += " kecid = " + args[7] + " ";
                }
            }
        } catch (Exception ex) {
        }
        if (thisCondition.length() > 0) {
            thisCondition = " where " + thisCondition;
        }
        qryData = "select id,jenis_aset,ket_jenis,nama_aset,lokasi,ranting,kecid"
                + ",(select b.namaKota from tbkota b where b.kotaID=kabid) as namaKabupaten"
                + ",(select a.namaKecamatan from tbkecamatan a where a.kecamatanID=kecid) as namaKecamatan"
                + "  from newaset" + thisCondition + " order by kecid,id";

        String klaSS = "jdbc:mysql://localhost/potensi?user=nujatim&password=klaser";
        try {
            Class.forName("com.mysql.jdbc.Driver").newInstance();
            java.sql.Connection conec = java.sql.DriverManager.getConnection(klaSS);
            parameter.put("qryData", qryData);
            parameter.put("imgPath", direktoryReport+"logoNU.png");
            net.sf.jasperreports.engine.JasperPrint jasperPrint = net.sf.jasperreports.engine.JasperFillManager.fillReport(fileReport, parameter, conec);
            if (debugging) {
                net.sf.jasperreports.view.JasperViewer jasperViewer = new net.sf.jasperreports.view.JasperViewer(jasperPrint, false);
                jasperViewer.setDefaultCloseOperation(javax.swing.JFrame.HIDE_ON_CLOSE);
                jasperViewer.setExtendedState(javax.swing.JFrame.MAXIMIZED_BOTH);
                jasperViewer.setTitle("Laporan Aset");
                jasperViewer.setVisible(true);
            }

            if (args[0].equalsIgnoreCase("pdf")) {
                pdfDestination = directoyPDF + args[4] + ".pdf";
                net.sf.jasperreports.engine.JasperExportManager.exportReportToPdfFile(jasperPrint, pdfDestination);
            } else if (args[0].equalsIgnoreCase("cetak")) {
                net.sf.jasperreports.engine.JasperPrintManager.printReport(jasperPrint, false);
            }


            System.exit(0);
        } catch (Exception ex) {
            if (debugging) {
                System.out.println(" error " + ex.getMessage());
            }
            System.exit(0);
        }
    }
}
