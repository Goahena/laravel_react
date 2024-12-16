
import { Button, Form, Grid, Input, theme, Typography } from "antd";

import { LockOutlined, UserAddOutlined } from "@ant-design/icons";
import ROUTE_PATH from "~/routes/route_Path";
import { useDispatch, useSelector } from "react-redux";
import { authThunks } from "~/stores/authStore/authThunks";
import LoadingSyncLoader from "~/components/loading/LoadingSyncLoader";

const { useToken } = theme;
const { useBreakpoint } = Grid;
const { Text, Title, Link } = Typography;

export default function Login() {
  const { token } = useToken();
  const screens = useBreakpoint();
  const dispatch = useDispatch()
  const {loading} = useSelector(state => state.authStore)
  const onFinish = (values) => {
    console.log("Received values of form: ", values);
    // values.
    dispatch(authThunks.apiLogin(values))
  };

  const styles = {
    container: {
      margin: "0 auto",
      padding: screens.md ? `${token.paddingXL}px` : `${token.sizeXXL}px ${token.padding}px`,
      width: "380px"
    },
    footer: {
      marginTop: token.marginLG,
      textAlign: "center",
      width: "100%"
    },
    forgotPassword: {
      float: "right"
    },
    header: {
      marginBottom: token.marginXL
    },
    section: {
      alignItems: "center",
      backgroundColor: token.colorBgContainer,
      display: "flex",
      height: screens.sm ? "50vh" : "auto",
      padding: screens.md ? `${token.sizeXXL}px 0px` : "0px"
    },
    text: {
      color: token.colorTextSecondary
    },
    title: {
      fontSize: screens.md ? token.fontSizeHeading2 : token.fontSizeHeading3
    }
  };

  return (
    <section style={styles.section}>
      {loading && <LoadingSyncLoader/>}
      <div style={styles.container}>
        <div style={styles.header}>
          <Title className="text-center" style={styles.title}>Đăng nhập</Title>
        </div>
        <Form
          name="normal_login"
          initialValues={{
            remember: true,
          }}
          onFinish={onFinish}
          layout="vertical"
          requiredMark="optional"
        >
          <Form.Item
            name="username"
            rules={[
              {
               
                required: true,
                message: "Vui lòng nhập tài khoản!",
              },
            ]}
          >
            <Input
              prefix={<UserAddOutlined />}
              placeholder="Tài khoản"
            />
          </Form.Item>
          <Form.Item
            name="password"
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
            <Button block="true"  htmlType="submit">
                Đăng nhập
            </Button>
          <Form.Item>
            <a style={styles.forgotPassword} href="">
              Forgot password?
            </a>
          </Form.Item>
            <div style={styles.footer}>
              <Text style={styles.text}>Bạn chưa có tài khoản?</Text>{" "}
              <Link href={ROUTE_PATH.REGISTER}>Đăng ký ngày</Link>
            </div>
          </Form.Item>
        </Form>
      </div>
    </section>
  );
}