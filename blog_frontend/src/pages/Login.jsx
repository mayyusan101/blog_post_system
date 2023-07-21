import Header from "../components/Header";
import { ErrorMessage, Field, Form, Formik } from "formik";
import * as Yup from "yup";
import { Link, useNavigate } from "react-router-dom";
import { useState } from "react";
import useToken from "../hooks/useToken";
import useAccont from "../hooks/useAccont";

const Login = () => {
  const [errorMsg, setErrorMsg] = useState("");
  const { storeToken } = useToken();
  const { accountLogin } = useAccont();
  const navigate = useNavigate();
  const initialValues = {
    email: "",
    password: "",
  };
  const submitForm = async (values, actions) => {
    const data = await login(values);
    if (data.token) {
      actions.resetForm();
      navigate("/");
    }
  };

  const login = async (values) => {
    const postData = {
      email: values.email,
      password: values.password,
    };
    try {
      const data = await accountLogin(postData); // call from coustom hook
      // invalid error
      if (data.error) {
        setErrorMsg(data.error.message);
        setTimeout(() => {
          setErrorMsg("");
        }, 5000); // close noti bar after 5s
      }
      // login success
      if (data.token) {
        storeToken(data); // call from coustom hook
      }
      return data;
    } catch (error) {
      console.log(error);
    }
  };
  const shema = Yup.object({
    email: Yup.string()
      .email("Invalid email address")
      .required("Email is required"),
    password: Yup.string()
      .min(6, "Password must be atleast 6 characters or more")
      .required("Password is required"),
  });

  return (
    <>
      <Header />
      <main>
        <div className="col-8 offset-2 my-5">
          <div className="shadow-sm p-4">
            {errorMsg && (
              <div className="alert alert-danger col-6 offset-6 mb-5 text-center">
                {errorMsg}
              </div>
            )}

            <Formik
              initialValues={initialValues}
              validationSchema={shema}
              onSubmit={submitForm}
            >
              {({ errors, touched }) => (
                <Form>
                  <div className="mb-3 row">
                    <label htmlFor="email" className="col-sm-2 col-form-label">
                      Email
                    </label>
                    <div className="col-sm-10">
                      <Field
                        type="text"
                        className={`form-control w-75 ${
                          errors.email && touched.email ? "is-invalid" : ""
                        }`}
                        id="email"
                        placeholder="Enter email...."
                        name="email"
                      />
                      <small className="invalid-feedback">
                        <ErrorMessage name="email" />
                      </small>
                    </div>
                  </div>
                  <div className="mb-3 mt-4 row">
                    <label
                      htmlFor="inputPassword"
                      className="col-sm-2 col-form-label"
                    >
                      Password
                    </label>
                    <div className="col-sm-10">
                      <Field
                        type="password"
                        className={`form-control w-75 ${
                          errors.password && touched.password
                            ? "is-invalid"
                            : ""
                        }`}
                        id="inputPassword"
                        placeholder="Enter password...."
                        name="password"
                      />
                      <small className="invalid-feedback">
                        <ErrorMessage name="password" />
                      </small>
                    </div>
                  </div>
                  <div className="form-group col-3 offset-6 mt-5 text-end">
                    <button
                      type="submit"
                      className="button button-contactForm boxed-btn"
                    >
                      Send
                    </button>
                  </div>
                </Form>
              )}
            </Formik>

            <div className="d-flex justify-content-end mt-3">
              <span>Don't have an account? </span>
              <Link
                to={"/register"}
                className="text-end text-primary text-decoration-underline"
              >
                register here
              </Link>
            </div>
          </div>
        </div>
      </main>
    </>
  );
};

export default Login;
