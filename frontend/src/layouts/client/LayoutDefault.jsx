import { Button, Dropdown, Layout, Modal, Space, theme } from "antd";
import { useEffect } from "react";
import { Link, Outlet, useNavigate } from "react-router-dom";
import { setNavigate } from "~/routes/navigateService";
import ROUTE_PATH from "~/routes/route_Path";
import { cookiesUtils } from "~/utils/cookies";
import getAccessToken from "~/utils/functions/getAccessToken";
const { Header, Content, Footer } = Layout;
const { confirm } = Modal;
const LayoutDefault = () => {
  const navigate = useNavigate();
  useEffect(() => {
    setNavigate(navigate);
  }, [navigate]);

  const items = [
    {
      label: <Button onClick={()=>handleLogout()}>Đăng xuất</Button>,
      key: "0",
    },
  ];

  const handleLogout = () => {
    console.log(123);
    confirm({
      title: "Bạn muốn đăng xuất không?",
      okText: "Đăng xuất",
      okType: "primary",
      cancelText: "Không",
      centered: true,
      onOk() {
        cookiesUtils.removeAccessToken()
      },
    });
  }

  const {
    token: { colorBgContainer, borderRadiusLG },
  } = theme.useToken();

  const logined = !!getAccessToken();
  return (
    <Layout>
      <Header
        style={{
          display: "flex",
          alignItems: "center",
          justifyContent: "space-between",
          position: "fixed",
          top: 0,
          right: 0,
          left: 0,
          zIndex: 1,
        }}
      >
        <div className=" text-white">LOGO</div>
        <div>
          <ul className="flex space-x-4">
            <li className="group">
              <Link
                to="/"
                className="relative text-[var(--textlight)] hover:text-[var(--textlight)]"
              >
                Trang chủ
                <span className="absolute left-0 bottom-0 w-0 h-[2px] bg-blue-500 transition-all duration-300 group-hover:w-full"></span>
              </Link>
            </li>
            <li className="group">
              <Link
                to="/about"
                className="relative text-[var(--textlight)] hover:text-[var(--textlight)]"
              >
                Thông tin về
                <span className="absolute left-0 bottom-0 w-0 h-[2px] bg-blue-500 transition-all duration-300 group-hover:w-full"></span>
              </Link>
            </li>
            <li className="group">
              <Link
                to={ROUTE_PATH.CONTACT}
                className="relative text-[var(--textlight)] hover:text-[var(--textlight)]"
              >
                Liên hệ
                <span className="absolute left-0 bottom-0 w-0 h-[2px] bg-blue-500 transition-all duration-300 group-hover:w-full"></span>
              </Link>
            </li>
            <li className="group">
              <Link
                to={ROUTE_PATH.SEARCH}
                className="relative text-[var(--textlight)] hover:text-[var(--textlight)]"
              >
                Tìm kiếm
                <span className="absolute left-0 bottom-0 w-0 h-[2px] bg-blue-500 transition-all duration-300 group-hover:w-full"></span>
              </Link>
            </li>
          </ul>
        </div>
        <div>
          {logined ? (
            <div className="text-white">
              <Dropdown
                menu={{
                  items,
                }}
                trigger={["click"]}
              >
                <Space>
                  Xin chào:
                </Space>
              </Dropdown>
            </div>
          ) : (
            <ul className="flex space-x-4">
              <li className="group">
                <Link
                  to={ROUTE_PATH.LOGIN}
                  className="p-3 rounded-sm border relative text-[var(--textlight)] hover:text-[var(--textlight)]"
                >
                  Đăng nhập
                  {/* Dòng kẻ dưới */}
                  <span className="absolute left-0 bottom-0 w-0 h-[2px] bg-blue-500 transition-all duration-300 group-hover:w-full"></span>
                </Link>
              </li>
              <li className="group">
                <Link
                  to={ROUTE_PATH.REGISTER}
                  className="relative text-[var(--textlight)] hover:text-[var(--textlight)]"
                >
                  Đăng ký
                </Link>
              </li>
            </ul>
          )}
        </div>
      </Header>
      <Content
        style={{
          padding: "0 48px",
        }}
      >
        <div
          className="mt-[80px]"
          style={{
            background: colorBgContainer,
            minHeight: 280,
            padding: 24,
            borderRadius: borderRadiusLG,
          }}
        >
          <Outlet />
        </div>
      </Content>
      <Footer
        style={{
          textAlign: "center",
        }}
      >
        FGC {new Date().getFullYear()} Created by FGC
      </Footer>
    </Layout>
  );
};
export default LayoutDefault;
