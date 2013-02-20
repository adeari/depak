

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
        if (args[3].equalsIgnoreCase("rincianKabupaten")
                ||args[3].equalsIgnoreCase("rincianKecamatan")
                ||args[3].equalsIgnoreCase("rincianDesa")) {
            fileReport = direktoryReport + "rincianPropinsi.jasper";
        }

        if (args[3].equalsIgnoreCase("newaasetLaporan")) {
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
                    + ",(select c.namaKelurahan from tbkelurahan c where c.kelurahanID=kelid ) as  namaKelurahan"
                    + "  from newaset" + thisCondition + " order by kecid,id";
        } else if (args[3].equalsIgnoreCase("rincianPropinsi")) {
            qryData = "SELECT newaset.jenis_aset, klasifikasi_aset.jenis, golongan.golongan,format(count(*),0) as jmlView, "
                    + "count(*) as jumlah "
                    + "FROM (newaset) "
                    + "JOIN klasifikasi_aset ON newaset.jenis_aset = klasifikasi_aset.kode_klasifikasi "
                    + "JOIN golongan ON klasifikasi_aset.golongan = golongan.id WHERE newaset.propid = " + args[5]
                    + " GROUP BY newaset.jenis_aset, klasifikasi_aset.jenis, golongan.golongan ORDER BY jenis_aset asc";
        } else if (args[3].equalsIgnoreCase("rincianKabupaten")) {
            qryData = "SELECT newaset.jenis_aset, klasifikasi_aset.jenis, golongan.golongan,format(count(*),0) as jmlView, "
                    + "count(*) as jumlah "
                    + "FROM (newaset) "
                    + "JOIN klasifikasi_aset ON newaset.jenis_aset = klasifikasi_aset.kode_klasifikasi "
                    + "JOIN golongan ON klasifikasi_aset.golongan = golongan.id WHERE newaset.kabid = " + args[5]
                    + " GROUP BY newaset.jenis_aset, klasifikasi_aset.jenis, golongan.golongan ORDER BY jenis_aset asc";
        } else if (args[3].equalsIgnoreCase("rincianKecamatan")) {
            qryData = "SELECT newaset.jenis_aset, klasifikasi_aset.jenis, golongan.golongan,format(count(*),0) as jmlView, "
                    + "count(*) as jumlah "
                    + "FROM (newaset) "
                    + "JOIN klasifikasi_aset ON newaset.jenis_aset = klasifikasi_aset.kode_klasifikasi "
                    + "JOIN golongan ON klasifikasi_aset.golongan = golongan.id WHERE newaset.kecid = " + args[5]
                    + " GROUP BY newaset.jenis_aset, klasifikasi_aset.jenis, golongan.golongan ORDER BY jenis_aset asc";
        } else if (args[3].equalsIgnoreCase("rincianDesa")) {
            qryData = "SELECT newaset.jenis_aset, klasifikasi_aset.jenis, golongan.golongan,format(count(*),0) as jmlView, "
                    + "count(*) as jumlah "
                    + "FROM (newaset) "
                    + "JOIN klasifikasi_aset ON newaset.jenis_aset = klasifikasi_aset.kode_klasifikasi "
                    + "JOIN golongan ON klasifikasi_aset.golongan = golongan.id WHERE newaset.kelid = " + args[5]
                    + " GROUP BY newaset.jenis_aset, klasifikasi_aset.jenis, golongan.golongan ORDER BY jenis_aset asc";
        } else if (args[3].equalsIgnoreCase("levelKabupaten")) {
            qryData = "select a.kabid,b.namaKota,count(*) as jumlah,format(count(*),0) as jmlView "
                    + "from newaset a inner join tbkota b on a.kabid = b.kotaID where a.propid = " + args[5]
                    + " group by a.kabid,b.namaKota order by b.namaKota";
        } else if (args[3].equalsIgnoreCase("levelKecamatan")) {
            qryData = "select a.kecid,b.namaKecamatan,count(*) as jumlah,"
                    + "format(count(*),0) as jmlView from newaset a "
                    + "inner join tbkecamatan b on a.kecid = b.kecamatanID where a.kabid = " + args[5]
                    + " group by a.kecid,b.namaKecamatan "
                    + "order by b.namaKecamatan";
        } else if (args[3].equalsIgnoreCase("levelDesa")) {
            qryData = "select a.kelid,b.namaKelurahan,count(*) as jumlah,format(count(*),0) as jmlView "
                    + "from newaset a "
                    + "inner join tbkelurahan b on a.kelid = b.kelurahanID where a.kecid =" + args[5]
                    + " group by a.kelid,b.namaKelurahan order by b.namaKelurahan";
        }
        
        

        String klaSS = "jdbc:mysql://localhost/potensi?user=nujatim&password=klaser";
        try {
            Class.forName("com.mysql.jdbc.Driver").newInstance();
            java.sql.Connection conec = java.sql.DriverManager.getConnection(klaSS);
            parameter.put("qryData", qryData);
            
            if (args[3].equalsIgnoreCase("rincianPropinsi")) {
                String namaPropinsi = args[6];
                int i = 7;
                boolean ada = true;
                while (ada) {
                    try {
                        namaPropinsi += " " + args[i];
                        i++;
                    } catch (Exception ex) {
                        ada = false;
                    }
                }
                parameter.put("rinciTitel", "Rincian Jumlah masing-masing obyek di Propinsi "+namaPropinsi);
            } else if (args[3].equalsIgnoreCase("rincianKabupaten")) {
                String namaKabupaten = args[6];
                int i = 7;
                boolean ada = true;
                while (ada) {
                    try {
                        namaKabupaten += " " + args[i];
                        i++;
                    } catch (Exception ex) {
                        ada = false;
                    }
                }
                parameter.put("rinciTitel", "Rincian Jumlah masing-masing obyek di "+namaKabupaten);
            } else if (args[3].equalsIgnoreCase("rincianKecamatan")) {
                String namaKecamatan = args[6];
                int i = 7;
                boolean ada = true;
                while (ada) {
                    try {
                        namaKecamatan += " " + args[i];
                        i++;
                    } catch (Exception ex) {
                        ada = false;
                    }
                }
                parameter.put("rinciTitel", "Rincian Jumlah masing-masing obyek di "+namaKecamatan);
            } else if (args[3].equalsIgnoreCase("rincianDesa")) {
                String namaDesa = args[6];
                int i = 7;
                boolean ada = true;
                while (ada) {
                    try {
                        namaDesa += " " + args[i];
                        i++;
                    } catch (Exception ex) {
                        ada = false;
                    }
                }
                parameter.put("rinciTitel", "Rincian Jumlah masing-masing obyek di Desa "+namaDesa);
            } else if (args[3].equalsIgnoreCase("levelKabupaten")) {
                String namaPropinsi = args[6];
                int i = 7;
                boolean ada = true;
                while (ada) {
                    try {
                        namaPropinsi += " " + args[i];
                        i++;
                    } catch (Exception ex) {
                        ada = false;
                    }
                }
                parameter.put("namaPropinsi", namaPropinsi);
            } else if (args[3].equalsIgnoreCase("levelKecamatan")) {
                String namaKabupaten = args[6];
                int i = 7;
                boolean ada = true;
                while (ada) {
                    try {
                        namaKabupaten += " " + args[i];
                        i++;
                    } catch (Exception ex) {
                        ada = false;
                    }
                }
                parameter.put("namaKabupaten", namaKabupaten);
            } else if (args[3].equalsIgnoreCase("levelDesa")) {
                String namaKecamatan = args[6];
                int i = 7;
                boolean ada = true;
                while (ada) {
                    try {
                        namaKecamatan += " " + args[i];
                        i++;
                    } catch (Exception ex) {
                        ada = false;
                    }
                }
                parameter.put("namaKecamatan", namaKecamatan);
            }
            
            parameter.put("imgPath", direktoryReport + "logoNU.png");
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
                System.out.println(" error " + ex.getMessage());
            System.exit(0);
        }
    }
}
