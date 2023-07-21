import Header from "../components/Header";
import { useState } from "react";
import { ErrorMessage, Field, Form, Formik } from "formik";
import * as Yup from "yup";
import { Link } from "react-router-dom";
import useToken from "../hooks/useToken";
import useAccount from "../hooks/useAccont";

const Register = () => {
  const { storeToken } = useToken();
  const { accountRegister } = useAccount();
  const initialValues = {
    name: "",
    email: "",
    phone: "",
    password: "",
    confirmPassword: "",
    gender: "male",
  };
  const submitForm = async (values, actions) => {
    const data = await register(values);
    if (data.token) {
      actions.resetForm();
    }
  };

  const [errorMessage, setErrorMessage] = useState("");
  const [registerSuccess, setRegisterSuccess] = useState(false);

  // register account
  const register = async (values) => {
    const postData = {
      name: values.name,
      email: values.email,
      phone: values.phone,
      password: values.password,
      gender: values.gender,
    };
    try {
      const data = await accountRegister(postData); // call from custom hook

      // email is already exists
      if (data[0]?.error?.email) {
        setErrorMessage(data[0].error.email);
        setRegisterSuccess(false);
        setTimeout(() => {
          setErrorMessage("");
        }, 5000);
      }
      if (data.token) {
        storeToken(data);
        setRegisterSuccess(true);
        setErrorMessage("");
        setTimeout(() => {
          setRegisterSuccess(false);
        }, 5000);
        return data;
      }
    } catch (error) {
      console.log(error);
    }
  };

  const shema = Yup.object({
    name: Yup.string()
      .max(15, "Must be 15 characters or less")
      .required("Name is required"),
    email: Yup.string()
      .email("Invalid email address")
      .required("Email is required"),
    phone: Yup.string().max(15, "Must be 15 characters or less"),
    password: Yup.string()
      .min(6, "Password must be atleast 6 characters or more")
      .required("Password is required"),
    confirmPassword: Yup.string()
      .min(6, "ConfirmPassword must be atleast 6 characters or more")
      .required("ConfirmPassword is required")
      .oneOf([Yup.ref("password"), null], "Passwords must match"),
  });

  return (
    <>
      <Header />
      <main>
        <div className="col-8 offset-2 my-5">
          {errorMessage && (
            <div className="col-8 offset-4">
              <div
                className="alert alert-warning alert-dismissible fade show"
                role="alert"
              >
                <strong>{errorMessage}</strong>
                <button
                  type="button"
                  className="btn-close"
                  data-bs-dismiss="alert"
                  aria-label="Close"
                ></button>
              </div>
            </div>
          )}
          {registerSuccess && (
            <div className="col-5 offset-7">
              <div
                className="alert alert-success alert-dismissible fade show"
                role="alert"
              >
                <strong>Register success</strong>
                <button
                  type="button"
                  className="btn-close"
                  data-bs-dismiss="alert"
                  aria-label="Close"
                ></button>
              </div>
            </div>
          )}
          <div className="shadow-sm p-4">
            <Formik
              initialValues={initialValues}
              validationSchema={shema}
              onSubmit={submitForm}
            >
              {({ errors, touched }) => (
                <Form>
                  <div className="mb-3 row">
                    <label htmlFor="name" className="col-sm-2 col-form-label">
                      Name
                    </label>
                    <div className="col-sm-10 ">
                      <Field
                        type="text"
                        className={`form-control w-75 ${
                          errors.name && touched.name ? "is-invalid" : ""
                        }`}
                        id="name"
                        placeholder="Enter name...."
                        name="name"
                      />
                      <small className="invalid-feedback">
                        <ErrorMessage name="name" />
                      </small>
                    </div>
                  </div>
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
                  <div className="mb-3 row">
                    <label htmlFor="phone" className="col-sm-2 col-form-label">
                      Phone
                    </label>
                    <div className="col-sm-10">
                      <Field
                        type="text"
                        className={`form-control w-75 ${
                          errors.phone && touched.phone ? "is-invalid" : ""
                        }`}
                        id="phone"
                        placeholder="Enter phone...."
                        name="phone"
                      />
                      <small className="invalid-feedback">
                        <ErrorMessage name="phone" />
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
                  <div className="mb-3 mt-4 row">
                    <label
                      htmlFor="comfirmPassword"
                      className="col-sm-2 col-form-label"
                    >
                      Confirm Password
                    </label>
                    <div className="col-sm-10">
                      <Field
                        type="password"
                        className={`form-control w-75 ${
                          errors.confirmPassword && touched.confirmPassword
                            ? "is-invalid"
                            : ""
                        }`}
                        id="comfirmPassword"
                        placeholder="Enter comfirm password...."
                        name="confirmPassword"
                      />
                      <small className="invalid-feedback">
                        <ErrorMessage name="confirmPassword" />
                      </small>
                    </div>
                  </div>
                  <div className="mb-3 mt-4 row">
                    <label htmlFor="gender" className="col-sm-2 col-form-label">
                      Gender
                    </label>
                    <div className="col-sm-10">
                      <Field
                        as="select"
                        name="gender"
                        className="form-control w-75"
                      >
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </Field>
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
              <span>Alreay have an account? </span>
              <Link
                to={"/login"}
                className="text-end text-primary text-decoration-underline"
              >
                login here
              </Link>
            </div>
          </div>
        </div>
      </main>
    </>
  );
};

export default Register;
