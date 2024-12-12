
# Kiểm tra nếu file .env đã tồn tại
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Nhập giá trị JWT_SECRET của bạn:"
    read JWT_SECRET
    echo "Nhập giá trị MEILISEARCH_KEY của bạn:"
    read MEILISEARCH_KEY

    # Thay thế các placeholder bằng giá trị thực
    sed -i "s/4m7zidEiDXPY2pF72fBCTKy9QO0UMmAaOw1U0b2FmhfpwU0joFeGilY7GGiUzNRG/$JWT_SECRET/g" .env
    sed -i "s/P_bKjtUOiDg6h01Ex75vwkQvbtm7W21EkMZOz0d3IcE/$MEILISEARCH_KEY/g" .env

    echo "Đã cập nhật file .env với các giá trị bí mật"
else
    echo "File .env đã tồn tại. Vui lòng kiểm tra và cập nhật nếu cần."
fi
