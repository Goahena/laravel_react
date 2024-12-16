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
            'tag' => 'cay-xang',
            'slug' => 'cay-xang-o-vung-tau-bi-dong-hoat-dong-do-nghi-gian-lan',
            'title' => 'Cây xăng ở Vũng Tàu bị dừng hoạt động do nghi gian lận',
            'description' => 'Cửa hàng xăng ở TP Vũng Tàu bị dừng hoạt động do cơ quan chức năng nghi ngờ doanh nghiệp tác động các trụ bơm để làm sai lệch kết quả đo khi bán cho khách.',
            'image' => '../storage/app/public/1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'author_id' => 1
        ]);
        Post::create([
            'id' => 2, 
            'tag' => 'hanoi',
            'slug' => 'hanoi-sap-xay-ba-cau-lon-viet-song-hong',
            'title' => 'Hà Nội sắp xây ba cầu lớn vượt sông Hồng',
            'description' => 'UBND TP Hà Nội vừa thống nhất chủ trương xây cầu Tứ Liên, Trần Hưng Đạo và Ngọc Hồi trong giai đoạn 2025-2030 bằng vốn đầu tư công.',
            'image' => '../storage/app/public/2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'author_id' => 1
        ]);
        Post::create([
            'id' => 3, 
            'tag' => 'siet-quan-ly-gia-thuoc',
            'slug' => 'siet-quan-ly-gia-thuoc',
            'title' => 'Siết quản lý giá thuốc',
            'description' => 'Chiều 21/11, Quốc hội thông qua dự Luật sửa đổi, bổ sung một số điều Luật Dược, trong đó có việc tăng cường quản lý giá thuốc. ',
            'image' => '../storage/app/public/3.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'author_id' => 1
        ]);
        Post::create([
            'id' => 4, 
            'tag' => 'xe-tai-lao-xuong-song-hai-nguoi-mat-tich',
            'slug' => 'xe-tai-lao-xuong-song-hai-nguoi-mat-tich',
            'title' => 'Xe tải lao xuống sông, hai người mất tích',
            'description' => 'Thừa Thiên - Huế Đang chạy qua cầu treo Bình Thành, xe tải chở rác chở theo hai người bất ngờ đâm vào lan can, rơi xuống dòng sông Hữu Trạch, sáng 21/11. ',
            'image' => '../storage/app/public/4.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'author_id' => 1
        ]);
        Post::create([
            'id' => 5, 
            'tag' => 'thu-truong-tai-chinh-lam-pho-chanh-van-phong-trung-uong-dang',
            'slug' => 'thu-truong-tai-chinh-lam-pho-chanh-van-phong-trung-uong-dang',
            'title' => 'Thứ trưởng Tài chính làm Phó chánh Văn phòng Trung ương Đảng',
            'description' => 'Ông Võ Thành Hưng, Thứ trưởng Tài chính, được Ban Bí thư điều động, bổ nhiệm giữ chức Phó chánh Văn phòng Trung ương Đảng.',
            'image' => '../storage/app/public/5.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'author_id' => 1
        ]);
        Post::create([
            'id' => 6, 
            'tag' => 'binh-phuc-lam-pho-ban-doi-ngoai-trung-uong',
            'slug' => 'binh-phuc-lam-pho-ban-doi-ngoai-trung-uong',
            'title' => 'Bí thư Bình Phước làm Phó ban Đối ngoại Trung ương',
            'description' => 'Ông Nguyễn Mạnh Cường, Bí thư Tỉnh ủy Bình Phước, được Bộ Chính trị điều động, bổ nhiệm giữ chức Phó ban Đối ngoại Trung ương.',
            'image' => '../storage/app/public/6.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'author_id' => 1
        ]);
    }
}