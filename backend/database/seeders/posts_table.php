<?php
 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Post;
class posts_table extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Post::create([
            'id' => 1, 
            'slug' => 'cay-xang-o-vung-tau-bi-dong-hoat-dong-do-nghi-gian-lan',
            'title' => 'Cây xăng ở Vũng Tàu bị dừng hoạt động do nghi gian lận',
            'body' => 'Cửa hàng xăng ở TP Vũng Tàu bị dừng hoạt động do cơ quan chức năng nghi ngờ doanh nghiệp tác động các trụ bơm để làm sai lệch kết quả đo khi bán cho khách.',
            'status' => 1,
            'images' => 'https://cdn.tgdd.vn/2022/05/news/20220512/xang-vung-tau-1-600x400.jpg',
            'views' => 100,
            'likes' => 100,
            'dislikes' => 100,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1
        ]);
        Post::create([
            'id' => 2, 
            'slug' => 'hanoi-sap-xay-ba-cau-lon-viet-song-hong',
            'title' => 'Hà Nội sắp xây ba cầu lớn vượt sông Hồng',
            'body' => 'UBND TP Hà Nội vừa thống nhất chủ trương xây cầu Tứ Liên, Trần Hưng Đạo và Ngọc Hồi trong giai đoạn 2025-2030 bằng vốn đầu tư công.',
            'status' => 1,
            'images' => 'https://cdn.tgdd.vn/2022/05/news/20220512/hanoi-sap-xay-ba-cau-lon-viet-song-hong-1-600x400.jpg',
            'views' => 100,
            'likes' => 100,
            'dislikes' => 100,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1
        ]);
        Post::create([
            'id' => 3, 
            'slug' => 'siet-quan-ly-gia-thuoc',
            'title' => 'Siết quản lý giá thuốc',
            'body' => 'Chiều 21/11, Quốc hội thông qua dự Luật sửa đổi, bổ sung một số điều Luật Dược, trong đó có việc tăng cường quản lý giá thuốc. ',
            'status' => 1,
            'images' => 'https://cdn.tgdd.vn/2022/05/news/20220512/siet-quan-ly-gia-thuoc-1-600x400.jpg',
            'views' => 100,
            'likes' => 100,
            'dislikes' => 100,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1
        ]);
        Post::create([
            'id' => 4, 
            'slug' => 'xe-tai-lao-xuong-song-hai-nguoi-mat-tich',
            'title' => 'Xe tải lao xuống sông, hai người mất tích',
            'body' => 'Thừa Thiên - Huế Đang chạy qua cầu treo Bình Thành, xe tải chở rác chở theo hai người bất ngờ đâm vào lan can, rơi xuống dòng sông Hữu Trạch, sáng 21/11. ',
            'status' => 1,
            'images' => 'https://cdn.tgdd.vn/2022/05/news/20220512/xe-tai-lao-xuong-song-hai-nguoi-mat-tich-1-600x400.jpg',
            'views' => 100,
            'likes' => 100,
            'dislikes' => 100,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1
        ]);
        Post::create([
            'id' => 5, 
            'slug' => 'thu-truong-tai-chinh-lam-pho-chanh-van-phong-trung-uong-dang',
            'title' => 'Thứ trưởng Tài chính làm Phó chánh Văn phòng Trung ương Đảng',
            'body' => 'Ông Võ Thành Hưng, Thứ trưởng Tài chính, được Ban Bí thư điều động, bổ nhiệm giữ chức Phó chánh Văn phòng Trung ương Đảng.',
            'status' => 1,
            'images' => 'https://cdn.tgdd.vn/2022/05/news/20220512/thuong-tai-chinh-lam-pho-chanh-van-phong-trung-uong-dang-1-600x400.jpg',
            'views' => 100,
            'likes' => 100,
            'dislikes' => 100,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1
        ]);
        Post::create([
            'id' => 6, 
            'slug' => 'binh-phuc-lam-pho-ban-doi-ngoai-trung-uong',
            'title' => 'Bí thư Bình Phước làm Phó ban Đối ngoại Trung ương',
            'body' => 'Ông Nguyễn Mạnh Cường, Bí thư Tỉnh ủy Bình Phước, được Bộ Chính trị điều động, bổ nhiệm giữ chức Phó ban Đối ngoại Trung ương.',
            'status' => 1,
            'images' => 'https://cdn.tgdd.vn/2022/05/news/20220512/binh-phuc-lam-pho-ban-doi-ngoai-trung-uong-1-600x400.jpg',
            'views' => 100,
            'likes' => 100,
            'dislikes' => 100,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1
        ]);
    }
}