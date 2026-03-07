<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $berita = [
            [
                'judul'          => 'Upacara Bendera Memperingati Hari Kemerdekaan RI ke-80',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-08-17',
                'isi'            => '<p>SD Negeri Warialau melaksanakan upacara bendera dalam rangka memperingati Hari Kemerdekaan Republik Indonesia yang ke-80 dengan penuh khidmat dan semangat. Seluruh siswa, guru, dan staf hadir mengenakan seragam lengkap. Kepala sekolah bertindak sebagai pembina upacara dan menyampaikan amanat tentang pentingnya semangat perjuangan bagi generasi muda. Kegiatan dilanjutkan dengan perlombaan antar kelas yang meriah seperti balap karung, tarik tambang, dan lomba mewarnai untuk kelas rendah.</p><p>Acara berjalan dengan tertib dan lancar. Para siswa tampak antusias mengikuti setiap rangkaian kegiatan. Momentum kemerdekaan ini dimanfaatkan sebagai kesempatan untuk menanamkan nilai-nilai cinta tanah air dan nasionalisme kepada seluruh peserta didik sejak dini.</p>',
            ],
            [
                'judul'          => 'Penerimaan Rapor Tengah Semester Ganjil 2025/2026',
                'kategori'       => 'Akademik',
                'tanggal_publish'=> '2025-10-15',
                'isi'            => '<p>SD Negeri Warialau telah melaksanakan kegiatan penerimaan rapor tengah semester ganjil tahun ajaran 2025/2026. Orang tua/wali murid diundang untuk hadir dan menerima laporan perkembangan belajar putra-putri mereka. Wali kelas masing-masing memberikan penjelasan mengenai capaian belajar siswa serta memberikan masukan untuk perbaikan ke depan.</p><p>Rata-rata nilai siswa pada semester ini menunjukkan peningkatan yang menggembirakan dibandingkan periode sebelumnya. Pihak sekolah berharap kerja sama yang baik antara orang tua dan guru dapat terus ditingkatkan demi kemajuan bersama.</p>',
            ],
            [
                'judul'          => 'Pelatihan Pramuka Tingkat Siaga dan Penggalang',
                'kategori'       => 'Ekstrakurikuler',
                'tanggal_publish'=> '2025-09-20',
                'isi'            => '<p>Gugus depan SD Negeri Warialau menyelenggarakan kegiatan pelatihan pramuka yang diikuti oleh siswa kelas III hingga VI. Materi pelatihan meliputi tali-temali, sandi morse, pertolongan pertama, dan baris-berbaris. Kegiatan berlangsung selama dua hari di lingkungan sekolah dengan didampingi pembina pramuka yang berpengalaman.</p><p>Melalui kegiatan ini, siswa dilatih untuk mandiri, disiplin, dan mampu bekerja sama dalam tim. Beberapa siswa berprestasi mendapatkan penghargaan berupa tanda kecakapan khusus sebagai bentuk apresiasi atas dedikasi mereka dalam berlatih.</p>',
            ],
            [
                'judul'          => 'Juara I Lomba Cerdas Cermat Tingkat Kecamatan',
                'kategori'       => 'Prestasi',
                'tanggal_publish'=> '2025-11-05',
                'isi'            => '<p>Tim cerdas cermat SD Negeri Warialau berhasil meraih juara pertama dalam perlombaan cerdas cermat tingkat kecamatan yang diselenggarakan di aula kantor kecamatan. Tim yang terdiri dari tiga siswa kelas VI ini berhasil mengalahkan 12 sekolah lain yang turut berkompetisi. Mereka menjawab seluruh pertanyaan dari berbagai mata pelajaran dengan tepat dan cepat.</p><p>Kepala sekolah mengucapkan selamat dan bangga atas prestasi yang diraih. Pencapaian ini merupakan buah dari latihan intensif yang dilakukan selama beberapa bulan terakhir dengan bimbingan guru-guru terbaik kami.</p>',
            ],
            [
                'judul'          => 'Kunjungan Dinas Pendidikan dalam Rangka Supervisi Akademik',
                'kategori'       => 'Berita',
                'tanggal_publish'=> '2025-10-28',
                'isi'            => '<p>Tim pengawas dari Dinas Pendidikan Kabupaten Kepulauan Aru melakukan kunjungan supervisi akademik ke SD Negeri Warialau. Kegiatan ini bertujuan untuk mengevaluasi proses pembelajaran yang berlangsung serta memastikan standar kualitas pendidikan terpenuhi sesuai ketentuan yang berlaku.</p><p>Selama kunjungan, tim pengawas melakukan observasi langsung ke beberapa kelas dan berdialog dengan kepala sekolah beserta para guru. Secara umum, hasil supervisi menunjukkan bahwa proses belajar mengajar di sekolah ini berjalan dengan baik dan sesuai standar nasional.</p>',
            ],
            [
                'judul'          => 'Pentas Seni Akhir Tahun: Merayakan Keberagaman Budaya Maluku',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-12-10',
                'isi'            => '<p>Pentas seni akhir tahun SD Negeri Warialau sukses digelar dengan menampilkan berbagai pertunjukan budaya khas Maluku. Siswa dari setiap kelas menampilkan tarian tradisional, nyanyian daerah, dan drama pendek yang mengangkat cerita rakyat setempat. Acara ini dihadiri oleh orang tua siswa, tokoh masyarakat, dan perwakilan dinas pendidikan.</p><p>Pentas seni ini merupakan wujud nyata komitmen sekolah dalam melestarikan kebudayaan daerah sekaligus mengembangkan bakat dan kreativitas siswa. Para orang tua tampak antusias menyaksikan penampilan putra-putri mereka di atas panggung.</p>',
            ],
            [
                'judul'          => 'Program Literasi Pagi: Membangun Kebiasaan Membaca',
                'kategori'       => 'Akademik',
                'tanggal_publish'=> '2025-09-01',
                'isi'            => '<p>SD Negeri Warialau resmi meluncurkan program literasi pagi yang dilaksanakan setiap hari Senin, Rabu, dan Jumat selama 15 menit sebelum jam pelajaran dimulai. Siswa diwajibkan membaca buku pilihan mereka sendiri, baik fiksi maupun nonfiksi, kemudian menceritakan kembali isinya secara lisan kepada teman sekelas.</p><p>Program ini bertujuan meningkatkan minat baca dan kemampuan berbahasa siswa. Perpustakaan sekolah telah dilengkapi dengan koleksi buku baru yang beragam sebagai bagian dari dukungan terhadap program ini. Dalam sebulan pertama, tingkat kunjungan perpustakaan meningkat hingga 60 persen.</p>',
            ],
            [
                'judul'          => 'Kegiatan Gotong Royong Bersih-Bersih Lingkungan Sekolah',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-09-27',
                'isi'            => '<p>Dalam rangka memperingati Hari Lingkungan Hidup Sedunia, seluruh warga SD Negeri Warialau bersama-sama melaksanakan kegiatan gotong royong membersihkan lingkungan sekolah dan sekitarnya. Kegiatan yang dimulai pukul 07.00 pagi ini melibatkan siswa dari kelas I hingga VI, seluruh guru, dan staf sekolah.</p><p>Area yang dibersihkan meliputi halaman sekolah, saluran air, dan jalan di sekitar sekolah. Siswa juga melakukan penanaman pohon buah di kebun sekolah sebagai bentuk kepedulian terhadap lingkungan. Kegiatan ini merupakan salah satu program rutin sekolah dalam membentuk karakter peduli lingkungan.</p>',
            ],
            [
                'judul'          => 'Wisuda Siswa Kelas VI Tahun Ajaran 2024/2025',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-06-14',
                'isi'            => '<p>Acara wisuda dan perpisahan siswa kelas VI SD Negeri Warialau tahun ajaran 2024/2025 berlangsung dengan penuh haru dan kebanggaan. Sebanyak 48 siswa dinyatakan lulus dan siap melanjutkan pendidikan ke jenjang berikutnya. Acara dihadiri oleh orang tua, tokoh masyarakat, dan alumni sekolah.</p><p>Kepala sekolah dalam sambutannya berpesan agar para siswa senantiasa menjaga nama baik sekolah dan terus semangat dalam mengejar cita-cita. Acara diisi dengan penampilan seni, pemberian hadiah bagi siswa berprestasi, dan sesi foto bersama yang mengabadikan momen berharga ini.</p>',
            ],
            [
                'judul'          => 'Peringatan Hari Guru Nasional 2025',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-11-25',
                'isi'            => '<p>SD Negeri Warialau merayakan Hari Guru Nasional dengan rangkaian kegiatan yang hangat dan berkesan. Siswa mempersembahkan puisi, lagu, dan kartu ucapan buatan tangan kepada para guru tercinta. Suasana penuh haru terpancar ketika siswa menyampaikan rasa terima kasih mereka secara langsung di hadapan wali kelas masing-masing.</p><p>Kepala sekolah juga memberikan apresiasi khusus kepada guru-guru yang telah menunjukkan dedikasi luar biasa selama tahun ini. Hari Guru menjadi momen refleksi bagi seluruh pendidik untuk terus meningkatkan kualitas pengajaran demi masa depan bangsa yang lebih cerah.</p>',
            ],
            [
                'judul'          => 'Sosialisasi Pendaftaran Siswa Baru Tahun Ajaran 2026/2027',
                'kategori'       => 'Pengumuman',
                'tanggal_publish'=> '2026-01-15',
                'isi'            => '<p>SD Negeri Warialau membuka pendaftaran siswa baru untuk tahun ajaran 2026/2027. Pendaftaran dibuka mulai 1 Februari hingga 31 Maret 2026. Calon siswa harus berusia minimal 6 tahun pada tanggal 1 Juli 2026 dan telah menyelesaikan pendidikan PAUD/TK atau sederajat.</p><p>Persyaratan dokumen yang diperlukan meliputi fotokopi akta kelahiran, kartu keluarga, dan pas foto terbaru. Kuota yang tersedia sebanyak 120 siswa untuk empat rombongan belajar. Informasi lebih lanjut dapat diperoleh langsung di kantor sekolah pada hari dan jam kerja.</p>',
            ],
            [
                'judul'          => 'Olimpiade Matematika Tingkat Sekolah Dasar Se-Kabupaten',
                'kategori'       => 'Prestasi',
                'tanggal_publish'=> '2025-10-10',
                'isi'            => '<p>Tiga orang siswa SD Negeri Warialau berhasil meraih medali dalam Olimpiade Matematika tingkat sekolah dasar se-Kabupaten Kepulauan Aru. Ketiganya masing-masing meraih medali emas, perak, dan perunggu pada kategori kelas tinggi. Prestasi ini merupakan yang terbaik sepanjang sejarah sekolah dalam kompetisi matematika.</p><p>Para pemenang telah menjalani pembinaan intensif selama tiga bulan sebelum kompetisi. Mereka juga akan mewakili kabupaten dalam olimpiade tingkat provinsi yang akan diselenggarakan bulan depan. Sekolah sangat bangga dan terus mendukung pengembangan potensi siswa di bidang akademik.</p>',
            ],
            [
                'judul'          => 'Pelatihan Dokter Kecil untuk Siswa Terpilih',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-08-25',
                'isi'            => '<p>Sebanyak 20 siswa terpilih dari kelas IV dan V mengikuti pelatihan Dokter Kecil yang bekerja sama dengan Puskesmas setempat. Materi pelatihan mencakup cara mencuci tangan yang benar, pertolongan pertama pada kecelakaan ringan, pemeriksaan kesehatan dasar, dan penyuluhan gizi. Para siswa terlihat sangat antusias mengikuti setiap sesi pelatihan.</p><p>Program Dokter Kecil merupakan bagian dari kegiatan UKS (Usaha Kesehatan Sekolah) yang bertujuan membentuk kader kesehatan di lingkungan sekolah. Diharapkan siswa yang telah terlatih dapat menjadi contoh dan mengajak teman-temannya untuk hidup sehat setiap hari.</p>',
            ],
            [
                'judul'          => 'Kunjungan Belajar ke Museum dan Situs Bersejarah Ambon',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-11-18',
                'isi'            => '<p>Siswa kelas V SD Negeri Warialau melaksanakan kunjungan belajar ke Museum Siwa Lima dan beberapa situs bersejarah di Kota Ambon. Kegiatan ini merupakan bagian dari pembelajaran IPS dan Sejarah yang bertujuan memberikan pengalaman belajar langsung di lapangan. Rombongan berangkat menggunakan kapal feri dan didampingi oleh guru-guru pendamping.</p><p>Di museum, siswa mendapatkan penjelasan dari pemandu mengenai sejarah Maluku, koleksi benda-benda bersejarah, dan perkembangan budaya daerah dari masa ke masa. Siswa juga diberi tugas untuk membuat laporan perjalanan yang akan dipresentasikan di kelas setelah kunjungan.</p>',
            ],
            [
                'judul'          => 'Lomba Baca Puisi dalam Rangka Bulan Bahasa',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-10-22',
                'isi'            => '<p>Dalam rangka memperingati Bulan Bahasa Oktober, SD Negeri Warialau mengadakan lomba baca puisi antar kelas. Setiap kelas mengirimkan satu perwakilan terbaik untuk bersaing dalam dua kategori: kelas rendah (I-III) dan kelas tinggi (IV-VI). Puisi yang dibacakan merupakan karya penyair terkenal Indonesia dan beberapa puisi karya siswa sendiri.</p><p>Dewan juri yang terdiri dari guru Bahasa Indonesia dan tamu undangan menilai berdasarkan aspek intonasi, penghayatan, dan ekspresi. Pemenang akan mewakili sekolah dalam lomba serupa di tingkat kecamatan yang dijadwalkan bulan depan.</p>',
            ],
            [
                'judul'          => 'Pelaksanaan Penilaian Akhir Semester Ganjil',
                'kategori'       => 'Akademik',
                'tanggal_publish'=> '2025-12-01',
                'isi'            => '<p>SD Negeri Warialau melaksanakan Penilaian Akhir Semester (PAS) Ganjil tahun ajaran 2025/2026 yang berlangsung selama enam hari kerja. Seluruh siswa kelas I hingga VI mengikuti ujian dengan tertib sesuai jadwal yang telah ditentukan. Sekolah menyiapkan pengawas dari guru kelas yang berbeda untuk memastikan pelaksanaan ujian berjalan jujur dan adil.</p><p>Orang tua diimbau untuk mendampingi anak-anak mereka belajar di rumah dan memastikan mereka beristirahat cukup selama periode ujian. Hasil PAS akan diumumkan bersamaan dengan penerimaan rapor akhir semester pada pertengahan bulan Desember.</p>',
            ],
            [
                'judul'          => 'Program Makan Bergizi Gratis untuk Siswa',
                'kategori'       => 'Berita',
                'tanggal_publish'=> '2026-01-06',
                'isi'            => '<p>SD Negeri Warialau turut berpartisipasi dalam program Makan Bergizi Gratis yang dicanangkan pemerintah pusat. Mulai semester genap tahun ajaran 2025/2026, seluruh siswa mendapatkan makanan bergizi secara gratis setiap hari sekolah. Menu makanan disusun oleh ahli gizi dan disesuaikan dengan kebutuhan nutrisi anak usia sekolah dasar.</p><p>Kepala sekolah menyambut baik program ini sebagai langkah nyata pemerintah dalam mendukung tumbuh kembang anak. Program ini diharapkan dapat meningkatkan konsentrasi dan prestasi belajar siswa karena kebutuhan gizi mereka terpenuhi dengan baik setiap harinya.</p>',
            ],
            [
                'judul'          => 'Peringatan Hari Anak Nasional dengan Berbagai Lomba Kreatif',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-07-23',
                'isi'            => '<p>Hari Anak Nasional yang jatuh pada 23 Juli diperingati SD Negeri Warialau dengan serangkaian lomba kreatif yang menyenangkan. Berbagai perlombaan digelar antara lain menggambar, mewarnai, membuat kerajinan dari bahan daur ulang, dan bercerita. Seluruh siswa berpartisipasi dengan penuh semangat dan kreativitas.</p><p>Puncak acara diisi dengan pertunjukan sulap anak dan hiburan lainnya yang membuat seluruh peserta tertawa dan bahagia. Momen ini dijadikan kesempatan untuk menegaskan hak-hak anak dan pentingnya menciptakan lingkungan yang aman dan menyenangkan bagi tumbuh kembang mereka.</p>',
            ],
            [
                'judul'          => 'Workshop Parenting: Mendidik Anak di Era Digital',
                'kategori'       => 'Berita',
                'tanggal_publish'=> '2025-09-13',
                'isi'            => '<p>SD Negeri Warialau menyelenggarakan workshop parenting bertema "Mendidik Anak di Era Digital" yang dihadiri oleh ratusan orang tua siswa. Narasumber adalah psikolog anak dari Ambon yang berpengalaman di bidang perkembangan anak dan teknologi. Workshop membahas tentang cara mendampingi anak menggunakan gadget secara sehat dan produktif.</p><p>Para orang tua mendapatkan wawasan praktis mengenai batasan waktu penggunaan gadget, konten yang aman untuk anak, serta cara membangun komunikasi yang terbuka antara orang tua dan anak. Workshop ini merupakan bagian dari program kemitraan sekolah dan keluarga yang rutin diselenggarakan setiap semester.</p>',
            ],
            [
                'judul'          => 'Turnamen Olahraga Antar Kelas: Memupuk Sportivitas',
                'kategori'       => 'Ekstrakurikuler',
                'tanggal_publish'=> '2025-08-09',
                'isi'            => '<p>Turnamen olahraga antar kelas yang diadakan SD Negeri Warialau berlangsung selama tiga hari dan mempertandingkan cabang bulu tangkis, tenis meja, dan futsal. Seluruh kelas dari IV hingga VI mengirimkan tim terbaiknya untuk bersaing memperebutkan trofi kejuaraan. Pertandingan dipimpin oleh guru PJOK dibantu oleh panitia siswa dari kelas VI.</p><p>Turnamen ini tidak hanya bertujuan mencari juara tetapi juga untuk menumbuhkan semangat sportivitas, kerja sama tim, dan jiwa kompetitif yang sehat. Antusiasme siswa dan dukungan penonton dari kelas-kelas lain menciptakan suasana yang sangat meriah di lapangan sekolah.</p>',
            ],
            [
                'judul'          => 'Bakti Sosial: Berbagi Kebahagiaan bersama Warga Sekitar Sekolah',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-12-22',
                'isi'            => '<p>Menjelang libur akhir tahun, SD Negeri Warialau menggelar kegiatan bakti sosial dengan membagikan sembako kepada warga kurang mampu di sekitar lingkungan sekolah. Donasi dikumpulkan dari sumbangan sukarela seluruh warga sekolah selama dua minggu sebelumnya. Sebanyak 50 paket sembako berhasil terkumpul dan diserahkan langsung oleh siswa kepada penerima.</p><p>Melalui kegiatan ini, siswa diajarkan untuk peduli terhadap sesama dan berbagi kebahagiaan dengan orang-orang yang membutuhkan. Nilai-nilai sosial dan kemanusiaan yang ditanamkan melalui aksi nyata seperti ini diharapkan dapat menjadi bekal karakter yang kuat bagi siswa sepanjang hidupnya.</p>',
            ],
            [
                'judul'          => 'Penghijauan Sekolah: Siswa Tanam Pohon untuk Masa Depan',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2026-01-20',
                'isi'            => '<p>Dalam rangka menyambut tahun baru 2026, SD Negeri Warialau mengadakan kegiatan penghijauan dengan menanam 100 bibit pohon di lingkungan sekolah dan area publik sekitarnya. Bibit pohon yang ditanam meliputi berbagai jenis tanaman buah dan tanaman hias yang dapat mempercantik lingkungan sekaligus bermanfaat bagi masyarakat.</p><p>Setiap siswa bertanggung jawab merawat satu pohon yang telah mereka tanam. Pohon-pohon tersebut diberi label nama siswa sebagai pengingat tanggung jawab mereka. Program ini merupakan bagian dari kurikulum pendidikan lingkungan yang terintegrasi dalam pembelajaran sehari-hari.</p>',
            ],
            [
                'judul'          => 'Rapat Wali Murid Semester Genap 2025/2026',
                'kategori'       => 'Pengumuman',
                'tanggal_publish'=> '2026-01-10',
                'isi'            => '<p>SD Negeri Warialau mengundang seluruh orang tua/wali murid untuk menghadiri rapat pleno awal semester genap yang akan diselenggarakan di aula sekolah. Rapat ini akan membahas program sekolah untuk semester mendatang, persiapan ujian akhir kelas VI, dan berbagai kegiatan yang akan dilaksanakan hingga akhir tahun ajaran.</p><p>Kehadiran orang tua dalam rapat ini sangat diharapkan karena banyak informasi penting yang perlu disampaikan dan diputuskan bersama. Pihak sekolah juga membuka kesempatan tanya jawab agar setiap aspirasi orang tua dapat ditampung dan ditindaklanjuti dengan sebaik-baiknya.</p>',
            ],
            [
                'judul'          => 'Kelas Memasak: Mengenal Kuliner Tradisional Maluku',
                'kategori'       => 'Ekstrakurikuler',
                'tanggal_publish'=> '2025-10-05',
                'isi'            => '<p>Sebagai bagian dari pengembangan karakter dan kecakapan hidup, SD Negeri Warialau mengadakan kelas memasak kuliner tradisional Maluku untuk siswa kelas V dan VI. Dipandu oleh narasumber yang merupakan ibu dari komunitas PKK setempat, siswa belajar membuat papeda, ikan bakar bumbu colo-colo, dan kue tradisional sagu lempeng.</p><p>Kegiatan ini tidak hanya mengajarkan keterampilan memasak tetapi juga memperkenalkan kekayaan kuliner daerah yang perlu dilestarikan. Hasil masakan kemudian dinikmati bersama-sama dan mendapat sambutan hangat dari seluruh peserta yang kagum dengan cita rasa masakan khas Maluku.</p>',
            ],
            [
                'judul'          => 'Peluncuran Program Adiwiyata Sekolah Peduli Lingkungan',
                'kategori'       => 'Berita',
                'tanggal_publish'=> '2025-08-01',
                'isi'            => '<p>SD Negeri Warialau secara resmi meluncurkan program Adiwiyata sebagai komitmen sekolah dalam menciptakan lingkungan yang bersih, sehat, dan lestari. Program ini mencakup pengelolaan sampah terpadu, pembuatan kompos, pembudidayaan tanaman di greenhouse sekolah, dan penghematan air serta energi.</p><p>Seluruh warga sekolah dilibatkan secara aktif dalam setiap kegiatan program ini. Sekolah menargetkan dapat meraih penghargaan Adiwiyata tingkat kabupaten pada akhir tahun 2026. Langkah-langkah konkret telah disiapkan dan program berjalan sesuai jadwal yang telah direncanakan.</p>',
            ],
            [
                'judul'          => 'Perlombaan Menggambar Bertema Kelautan untuk Kelas Rendah',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-10-01',
                'isi'            => '<p>Menyambut Hari Maritim Nasional, SD Negeri Warialau mengadakan lomba menggambar bertema kelautan dan kehidupan laut untuk siswa kelas I hingga III. Tema ini dipilih sebagai bentuk penghargaan terhadap kekayaan laut Maluku yang menjadi sumber kehidupan masyarakat setempat. Peserta bebas berkreasi menggunakan krayon, pensil warna, atau cat air.</p><p>Hasil karya para siswa dipajang di koridor sekolah selama satu minggu sehingga dapat diapresiasi oleh seluruh warga sekolah dan pengunjung. Pemenang mendapatkan hadiah berupa perlengkapan seni dan piagam penghargaan dari kepala sekolah.</p>',
            ],
            [
                'judul'          => 'Pelatihan Komputer Dasar untuk Siswa Kelas IV-VI',
                'kategori'       => 'Akademik',
                'tanggal_publish'=> '2025-07-14',
                'isi'            => '<p>Memanfaatkan fasilitas laboratorium komputer yang baru, SD Negeri Warialau menyelenggarakan pelatihan komputer dasar untuk siswa kelas IV, V, dan VI. Materi pelatihan meliputi pengenalan komputer, Microsoft Word, Microsoft Excel, dan internet yang aman untuk pelajar. Pelatihan dilaksanakan secara bergantian sesuai jadwal yang telah ditentukan.</p><p>Program ini diharapkan dapat mempersiapkan siswa dalam menghadapi era digital yang semakin berkembang pesat. Guru TIK juga memberikan pemahaman tentang etika penggunaan internet dan bahaya konten negatif yang harus dihindari oleh anak-anak.</p>',
            ],
            [
                'judul'          => 'Kerja Sama dengan Perpustakaan Daerah: Pojok Baca Baru',
                'kategori'       => 'Berita',
                'tanggal_publish'=> '2025-09-08',
                'isi'            => '<p>SD Negeri Warialau menjalin kerja sama dengan Perpustakaan Daerah Kabupaten Kepulauan Aru untuk meningkatkan fasilitas literasi di sekolah. Sebagai hasil kerja sama ini, sekolah mendapatkan donasi ratusan buku bacaan berkualitas yang akan memperkaya koleksi perpustakaan yang sudah ada. Pojok baca baru juga dibuat di beberapa sudut strategis di lingkungan sekolah.</p><p>Pojok baca yang nyaman dan menarik ini diharapkan dapat mendorong siswa untuk lebih sering membaca di waktu luang mereka. Setiap pojok baca dilengkapi dengan rak buku, karpet, dan bantal duduk yang membuat aktivitas membaca menjadi lebih menyenangkan dan tidak membosankan.</p>',
            ],
            [
                'judul'          => 'Simulasi Bencana: Melatih Kesiapsiagaan Siswa',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-11-11',
                'isi'            => '<p>Bekerja sama dengan BPBD Kabupaten Kepulauan Aru, SD Negeri Warialau mengadakan simulasi bencana alam berupa gempa bumi dan tsunami. Kegiatan ini bertujuan melatih kesiapsiagaan dan kemampuan evakuasi seluruh warga sekolah dalam situasi darurat. Siswa diajarkan cara berlindung yang benar dan jalur evakuasi yang aman.</p><p>Simulasi berjalan dengan lancar meskipun ada beberapa momen yang membuat siswa cukup tegang. Tim dari BPBD juga memberikan edukasi mengenai cara membaca tanda-tanda alam sebelum bencana terjadi. Kesiapsiagaan ini penting mengingat wilayah Maluku berada di kawasan yang rawan bencana alam.</p>',
            ],
            [
                'judul'          => 'Pameran Karya Siswa: Kreativitas Tanpa Batas',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-12-05',
                'isi'            => '<p>SD Negeri Warialau menggelar pameran karya siswa yang menampilkan berbagai hasil kreasi terbaik dari kegiatan pembelajaran selama satu semester. Karya yang dipamerkan meliputi prakarya, gambar, puisi, cerita pendek, model sains, dan hasil kerajinan tangan dari berbagai bahan. Pameran berlangsung selama dua hari dan terbuka untuk umum.</p><p>Ratusan pengunjung dari kalangan orang tua, warga sekitar, dan siswa dari sekolah lain datang menyaksikan pameran yang dipenuhi karya-karya impresif. Siswa pameran mendapatkan pengalaman berharga dalam mempresentasikan karya mereka dan menerima apresiasi dari para pengunjung.</p>',
            ],
            [
                'judul'          => 'Pendidikan Karakter: Seminar Anti Bullying di Sekolah',
                'kategori'       => 'Berita',
                'tanggal_publish'=> '2025-10-19',
                'isi'            => '<p>SD Negeri Warialau mengadakan seminar pendidikan karakter bertema anti bullying yang diikuti oleh seluruh siswa kelas IV hingga VI beserta para orang tua. Narasumber dari LSM perlindungan anak memaparkan tentang bentuk-bentuk perundungan, dampaknya bagi korban, serta cara melaporkan dan mencegah bullying di lingkungan sekolah.</p><p>Sekolah berkomitmen untuk menciptakan lingkungan belajar yang aman, nyaman, dan bebas dari segala bentuk kekerasan. Setelah seminar, sekolah membentuk tim khusus anti bullying yang terdiri dari guru dan siswa untuk memantau dan menangani setiap kasus perundungan yang mungkin terjadi.</p>',
            ],
            [
                'judul'          => 'Festival Budaya: Menampilkan Kekayaan Seni Maluku',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-11-28',
                'isi'            => '<p>Festival Budaya tahunan SD Negeri Warialau kembali digelar dengan mengusung tema "Maluku Bhineka Tunggal Ika". Siswa dari berbagai latar belakang budaya menampilkan tarian, lagu, alat musik tradisional, dan permainan daerah yang mewakili keberagaman suku dan budaya yang ada di Kepulauan Aru. Acara berlangsung meriah selama satu hari penuh.</p><p>Festival ini menjadi ajang yang tepat untuk menanamkan rasa cinta dan kebanggaan terhadap budaya daerah sekaligus mempererat persaudaraan antar siswa yang berasal dari berbagai latar belakang. Kepala sekolah berharap festival seperti ini dapat terus menjadi agenda tahunan yang semakin berkembang setiap tahunnya.</p>',
            ],
            [
                'judul'          => 'Hasil Ujian Nasional Berbasis Komputer: Prestasi Membanggakan',
                'kategori'       => 'Prestasi',
                'tanggal_publish'=> '2025-06-05',
                'isi'            => '<p>SD Negeri Warialau berhasil mencapai nilai rata-rata tertinggi se-kecamatan dalam ujian akhir sekolah tahun ajaran 2024/2025. Nilai rata-rata sekolah mencapai 84,7 dengan mata pelajaran Bahasa Indonesia menjadi yang tertinggi. Sebanyak 5 siswa meraih nilai sempurna pada satu atau lebih mata pelajaran yang diujikan.</p><p>Prestasi ini merupakan hasil kerja keras seluruh komponen sekolah, mulai dari guru yang membimbing dengan penuh dedikasi, siswa yang belajar tekun, hingga orang tua yang mendukung di rumah. Sekolah terus berupaya meningkatkan kualitas pembelajaran agar prestasi ini dapat dipertahankan dan terus ditingkatkan di tahun mendatang.</p>',
            ],
            [
                'judul'          => 'Pembinaan Nilai-nilai Pancasila dalam Kehidupan Sehari-hari',
                'kategori'       => 'Akademik',
                'tanggal_publish'=> '2025-08-19',
                'isi'            => '<p>Pasca peringatan kemerdekaan, SD Negeri Warialau mengintegrasikan penguatan nilai-nilai Pancasila dalam kegiatan pembelajaran sehari-hari. Setiap pagi, sebelum pelajaran dimulai, siswa bersama-sama membacakan sila-sila Pancasila dan mendiskusikan satu contoh penerapannya dalam kehidupan nyata. Program ini dirancang untuk membuat Pancasila terasa relevan dan bermakna bagi generasi muda.</p><p>Guru-guru juga diberikan pelatihan khusus tentang cara mengintegrasikan nilai Pancasila secara natural dalam setiap mata pelajaran. Pendekatan kontekstual ini diharapkan lebih efektif dalam membentuk karakter siswa dibandingkan hafalan semata.</p>',
            ],
            [
                'judul'          => 'Pemilihan Ketua OSIS dan Pengurus MPK 2025/2026',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-07-28',
                'isi'            => '<p>SD Negeri Warialau melaksanakan pemilihan ketua OSIS dan pengurus MPK secara demokratis dengan melibatkan seluruh siswa kelas IV, V, dan VI sebagai pemilih. Proses pemilihan berlangsung dengan tertib menggunakan sistem pemungutan suara yang menyerupai pemilihan umum sesungguhnya. Setiap kandidat berkesempatan menyampaikan visi dan misi mereka di hadapan seluruh pemilih.</p><p>Kegiatan ini merupakan sarana pembelajaran demokrasi secara langsung bagi siswa. Terpilihnya ketua OSIS yang baru diharapkan dapat membawa semangat baru dan program-program inovatif yang bermanfaat bagi seluruh warga sekolah selama masa baktinya.</p>',
            ],
            [
                'judul'          => 'Tes Kesehatan Rutin dan Pemeriksaan Gigi Gratis untuk Siswa',
                'kategori'       => 'Berita',
                'tanggal_publish'=> '2025-09-15',
                'isi'            => '<p>Bekerja sama dengan Puskesmas Kecamatan, SD Negeri Warialau menyelenggarakan pemeriksaan kesehatan rutin dan pemeriksaan gigi gratis untuk seluruh siswa. Tim medis yang terdiri dari dokter umum, dokter gigi, dan perawat memberikan layanan pemeriksaan langsung di sekolah sehingga tidak mengganggu waktu belajar. Setiap siswa mendapatkan rekam kesehatan yang dapat dibawa pulang untuk orang tua.</p><p>Beberapa siswa yang teridentifikasi memiliki masalah kesehatan tertentu langsung dirujuk untuk mendapatkan penanganan lebih lanjut. Program rutin ini merupakan wujud komitmen sekolah dalam memastikan kesehatan siswa terjaga dengan baik sepanjang tahun ajaran.</p>',
            ],
            [
                'judul'          => 'Pelatihan Menulis Kreatif: Mengasah Bakat Penulis Muda',
                'kategori'       => 'Ekstrakurikuler',
                'tanggal_publish'=> '2025-10-12',
                'isi'            => '<p>Club Literasi SD Negeri Warialau menyelenggarakan pelatihan menulis kreatif yang dipandu oleh penulis muda asal Ambon yang telah menerbitkan beberapa buku. Siswa kelas IV, V, dan VI yang tergabung dalam klub ini mendapatkan materi tentang teknik menulis cerita pendek, puisi, dan artikel opini. Setiap peserta diminta menghasilkan satu karya tulis selama pelatihan.</p><p>Karya-karya terbaik akan dikumpulkan dalam antologi tulisan siswa yang akan dicetak dan didistribusikan sebagai kenang-kenangan. Kegiatan ini tidak hanya mengasah kemampuan menulis tetapi juga menumbuhkan kepercayaan diri siswa dalam mengekspresikan pikiran dan perasaan melalui tulisan.</p>',
            ],
            [
                'judul'          => 'Program Beasiswa untuk Siswa Berprestasi dari Keluarga Kurang Mampu',
                'kategori'       => 'Pengumuman',
                'tanggal_publish'=> '2025-08-04',
                'isi'            => '<p>SD Negeri Warialau dengan bangga mengumumkan program beasiswa bagi siswa berprestasi yang berasal dari keluarga kurang mampu. Beasiswa ini mencakup pembebasan dari berbagai iuran sekolah, penyediaan perlengkapan belajar, dan uang saku bulanan. Dana beasiswa bersumber dari donasi alumni dan mitra sekolah yang peduli terhadap pendidikan.</p><p>Seleksi penerima beasiswa didasarkan pada nilai akademik, prestasi non-akademik, dan kondisi ekonomi keluarga. Sekolah berkomitmen bahwa keterbatasan ekonomi tidak boleh menjadi penghalang bagi anak-anak yang memiliki semangat dan kemampuan untuk meraih pendidikan berkualitas.</p>',
            ],
            [
                'judul'          => 'Persiapan Kompetisi Robotika Pertama SD Negeri Warialau',
                'kategori'       => 'Prestasi',
                'tanggal_publish'=> '2026-02-03',
                'isi'            => '<p>Untuk pertama kalinya dalam sejarahnya, SD Negeri Warialau akan mengikuti kompetisi robotika yang diselenggarakan di Ambon. Tim yang terdiri dari 6 siswa kelas V dan VI telah menjalani latihan intensif selama dua bulan di bawah bimbingan guru TIK dan pelatih dari komunitas teknologi setempat. Mereka mempelajari dasar-dasar pemrograman robot menggunakan kit robotika sederhana.</p><p>Keikutsertaan pertama dalam kompetisi robotika ini merupakan langkah awal yang berani dari sebuah sekolah di kepulauan terpencil. Sekolah sangat bangga dengan keberanian dan semangat siswa yang tidak takut untuk bersaing di bidang teknologi meskipun dengan keterbatasan sarana yang ada.</p>',
            ],
            [
                'judul'          => 'Renovasi dan Perluasan Ruang Kelas Baru Selesai Dikerjakan',
                'kategori'       => 'Berita',
                'tanggal_publish'=> '2026-01-25',
                'isi'            => '<p>Proyek renovasi dan perluasan ruang kelas SD Negeri Warialau yang telah berlangsung selama enam bulan akhirnya rampung dikerjakan. Dua ruang kelas baru yang representatif dan modern telah siap digunakan mulai semester genap tahun ajaran 2025/2026. Fasilitas baru ini dilengkapi dengan papan tulis interaktif, pencahayaan yang baik, dan ventilasi yang memadai.</p><p>Penambahan ruang kelas ini sangat diperlukan mengingat terus meningkatnya jumlah siswa baru yang mendaftar setiap tahunnya. Kepala sekolah menyampaikan terima kasih kepada pemerintah daerah dan semua pihak yang telah mendukung terwujudnya fasilitas baru yang akan meningkatkan kenyamanan belajar bagi seluruh siswa.</p>',
            ],
            [
                'judul'          => 'Khataman Al-Quran: Kebanggaan Siswa Muslim SD Negeri Warialau',
                'kategori'       => 'Kegiatan',
                'tanggal_publish'=> '2025-07-05',
                'isi'            => '<p>Sebanyak 15 siswa Muslim dari SD Negeri Warialau berhasil mengkhatamkan Al-Quran dalam acara syukuran yang diselenggarakan di masjid dekat sekolah. Acara yang dihadiri oleh orang tua, guru, dan tokoh agama setempat ini berlangsung dengan penuh kekhusyukan dan kebahagiaan. Setiap siswa yang khatam mendapatkan hadiah Al-Quran baru dari sekolah sebagai kenang-kenangan.</p><p>Pencapaian ini merupakan hasil dari pembinaan TPA (Taman Pendidikan Al-Quran) yang rutin diselenggarakan setiap sore setelah jam sekolah. Sekolah mendorong semua siswa sesuai agamanya masing-masing untuk mendalami pendidikan agama sebagai fondasi karakter yang kuat.</p>',
            ],
        ];

        foreach ($berita as $b) {
            Berita::create(array_merge($b, [
                'user_id' => 1,
                'status'  => 'publish',
            ]));
        }
    }
}
