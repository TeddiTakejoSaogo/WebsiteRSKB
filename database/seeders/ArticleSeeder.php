<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => 'Tips Menjaga Kesehatan Jantung di Usia Muda',
                'slug' => 'tips-menjaga-kesehatan-jantung-di-usia-muda',
                'content' => '<h2>Pentingnya Kesehatan Jantung</h2>
                            <p>Jantung adalah organ vital yang perlu dijaga kesehatannya sejak dini. Dengan pola hidup yang sehat, kita dapat mencegah berbagai penyakit jantung yang berbahaya.</p>
                            
                            <h3>Tips Menjaga Kesehatan Jantung</h3>
                            <ul>
                                <li><strong>Olahraga teratur</strong> minimal 30 menit per hari</li>
                                <li><strong>Konsumsi makanan sehat</strong> dan rendah lemak jenuh</li>
                                <li><strong>Hindari merokok</strong> dan konsumsi alkohol berlebihan</li>
                                <li><strong>Kelola stres</strong> dengan teknik relaksasi</li>
                                <li><strong>Periksa tekanan darah</strong> secara rutin</li>
                            </ul>
                            
                            <p>Dengan menerapkan pola hidup sehat, risiko penyakit jantung dapat diminimalisir secara signifikan.</p>',
                'category' => 'Kesehatan Jantung',
                'status' => 'published'
            ],
            [
                'title' => 'Pentingnya Vaksinasi untuk Anak',
                'slug' => 'pentingnya-vaksinasi-untuk-anak',
                'content' => '<h2>Mengapa Vaksinasi Penting?</h2>
                            <p>Vaksinasi merupakan salah satu upaya pencegahan penyakit yang paling efektif pada anak. Vaksin membantu sistem kekebalan tubuh anak untuk melawan penyakit-penyakit berbahaya.</p>
                            
                            <h3>Jadwal Vaksinasi Wajib</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Vaksin</th>
                                        <th>Penyakit yang Dicegah</th>
                                        <th>Waktu Pemberian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>BCG</td>
                                        <td>Tuberculosis (TBC)</td>
                                        <td>Saat lahir</td>
                                    </tr>
                                    <tr>
                                        <td>DPT</td>
                                        <td>Difteri, Pertusis, Tetanus</td>
                                        <td>2, 3, 4 bulan</td>
                                    </tr>
                                    <tr>
                                        <td>Polio</td>
                                        <td>Poliomyelitis</td>
                                        <td>2, 3, 4 bulan</td>
                                    </tr>
                                    <tr>
                                        <td>Hepatitis B</td>
                                        <td>Hepatitis B</td>
                                        <td>Saat lahir</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <p>Pastikan anak Anda mendapatkan vaksinasi lengkap sesuai jadwal yang telah ditentukan.</p>',
                'category' => 'Kesehatan Anak',
                'status' => 'published'
            ],
            [
                'title' => 'Cara Mencegah Diabetes Melitus',
                'slug' => 'cara-mencegah-diabetes-melitus',
                'content' => '<h2>Memahami Diabetes Melitus</h2>
                            <p>Diabetes melitus adalah penyakit metabolik yang ditandai dengan kadar gula darah tinggi. Penyakit ini dapat dicegah dengan pola hidup yang sehat.</p>
                            
                            <h3>Langkah Pencegahan Diabetes</h3>
                            <ol>
                                <li>Jaga berat badan ideal</li>
                                <li>Konsumsi makanan berserat tinggi</li>
                                <li>Batasi asupan gula dan karbohidrat sederhana</li>
                                <li>Olahraga teratur minimal 150 menit per minggu</li>
                                <li>Periksa gula darah secara berkala</li>
                                <li>Hindari stres berlebihan</li>
                            </ol>
                            
                            <blockquote>
                                <p>Pencegahan sejak dini lebih baik daripada pengobatan. Mulailah hidup sehat dari sekarang!</p>
                            </blockquote>',
                'category' => 'Penyakit Dalam',
                'status' => 'published'
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}