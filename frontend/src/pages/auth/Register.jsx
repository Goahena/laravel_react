import { Button, Form, Grid, Input, theme, Typography } from "antd";

import { LockOutlined, MailOutlined, UserOutlined } from "@ant-design/icons";
import ROUTE_PATH from "~/routes/route_Path";
import { useDispatch, useSelector } from "react-redux";
import { authThunks } from "~/stores/authStore/authThunks";
import LoadingSyncLoader from "~/components/loading/LoadingSyncLoader";

const { useToken } = theme;
const { useBreakpoint } = Grid;
const { Text, Title, Link } = Typography;

export default function Register() {
  const { token } = useToken();
  const screens = useBreakpoint();
  const dispatch = useDispatch();
  const {loading} = useSelector(state => state.authStore)

  const onFinish = (values) => {
    values.c_password = values.password;
    dispatch(authThunks.apiRegister(values))
  };

  const styles = {
    container: {
      margin: "0 auto",
      padding: screens.md
        ? `${token.paddingXL}px`
        : `${token.paddingXL}px ${token.padding}px`,
      width: "380px",
    },
    forgotPassword: {
      float: "right",
    },
    header: {
      marginBottom: token.marginXL,
      textAlign: "center",
    },
    section: {
      alignItems: "center",
      backgroundColor: token.colorBgContainer,
      display: "flex",
      height: screens.sm ? "70vh" : "auto",
      padding: screens.md ? `${token.sizeXXL}px 0px` : "0px",
    },
    signup: {
      marginTop: token.marginLG,
      textAlign: "center",
      width: "100%",
    },
    text: {
      color: token.colorTextSecondary,
    },
    title: {
      fontSize: screens.md ? token.fontSizeHeading2 : token.fontSizeHeading3,
    },
  };

  return (
    <section style={styles.section}>
    {loading  && <LoadingSyncLoader/>}
      <div style={styles.container}>
        <div style={styles.header}>
          <Title style={styles.title}>Đăng ký</Title>
        </div>
        <Form
          name="normal_signup"
          onFinish={onFinish}
          layout="vertical"
          requiredMark="optional"
        >
          <Form.Item
            name="fullname"
            rules={[
              {
                required: true,
                message: "Please input your Name!",
              },
            ]}
          >
            <Input prefix={<UserOutlined />} placeholder="Họ tên" />
          </Form.Item>
          <Form.Item
            name="username"
            rules={[
              {
                required: true,
                message: "Vui lòng nhập username!",
              },
            ]}
          >
            <Input prefix={<MailOutlined />} placeholder="Username" />
          </Form.Item>
          <Form.Item
            name="email"
            rules={[
              {
                type: "email",
                required: true,
                message: "Vui lòng nhập email!",
              },
            ]}
          >
            <Input prefix={<MailOutlined />} placeholder="Email" />
          </Form.Item>
          <Form.Item
            name="phone"
            rules={[
              {
                required: true,
                message: "Vui lòng nhập số điện thoại!",
              },
            ]}
          >
            <Input prefix={<MailOutlined />} placeholder="Số điện thoại" />
          </Form.Item>
          <Form.Item
            name="password"
            extra="Mật khẩu cần ít nhất 6 ký tự."
            rules={[
              {
                required: true,
                message: "Vui lòng nhập mật khẩu!",
              },
            ]}
          >
            <Input.Password
              prefix={<LockOutlined />}
              type="password"
              placeholder="Mật khẩu"
            />
          </Form.Item>
          <Form.Item style={{ marginBottom: "0px" }}>
            <Button block htmlType="submit">
              Đăng ký
            </Button>
            <div style={styles.signup}>
              <Text style={styles.text}>Bạn đã có tài khoản?</Text>
              <Link href={ROUTE_PATH.LOGIN}>Đăng nhập</Link>
            </div>
          </Form.Item>
        </Form>
      </div>
    </section>
  );
}
