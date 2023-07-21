import Header from "../components/Header";
import { ErrorMessage, Field, Form, Formik } from "formik";
import * as Yup from "yup";
import { url } from "../api/QuerisFn";
import { useState } from "react";

const Contact = () => {
  const [successStatus, setSuccessStatus] = useState(false);

  const initialValues = {
    message: "",
    name: "",
    email: "",
    subject: "",
  };

  // send contact form
  const sendContact = async (form) => {
    const response = await url.post("/api/user/contact", { ...form });
    return response.data;
  };
  const submitForm = async (values, actions) => {
    const data = await sendContact(values); // call from custom hook
    if (data.status === "success") {
      setSuccessStatus(true);
      setTimeout(() => {
        actions.resetForm();
      }, [1000]);
    }
  };

  const shema = Yup.object({
    name: Yup.string()
      .max(15, "Must be 15 characters or less")
      .required("Name is required"),
    email: Yup.string()
      .email("Invalid email address")
      .required("Email is required"),
    message: Yup.string().required("Message is required"),
    subject: Yup.string().required("Subject is required"),
  });

  return (
    <>
      <Header />
      <div>
        <div className="container mt-4 ">
          <div className="col-12 col-md-8 offset-md-2">
            <div
              className="form-contact contact_form p-2 p-md-5 shadow-sm"
              id="contactForm"
            >
              {successStatus && (
                <div className="col-8 offset-4">
                  <div
                    className="alert alert-warning alert-dismissible fade show"
                    role="alert"
                  >
                    <strong>
                      Thank you for your advice! We'll contact you later..
                    </strong>
                    <button
                      type="button"
                      className="btn-close"
                      data-bs-dismiss="alert"
                      aria-label="Close"
                    ></button>
                  </div>
                </div>
              )}
              <Formik
                initialValues={initialValues}
                validationSchema={shema}
                onSubmit={submitForm}
              >
                {({ errors, touched }) => (
                  <Form>
                    <div className="row">
                      <div className="col-12">
                        <div className="form-group">
                          <Field
                            as="textarea"
                            cols="30"
                            rows="9"
                            className={`form-control w-75 ${
                              errors.message && touched.message
                                ? "is-invalid"
                                : ""
                            }`}
                            id="message"
                            placeholder="Enter message...."
                            name="message"
                          />
                          <small className="invalid-feedback">
                            <ErrorMessage name="message" />
                          </small>
                        </div>
                      </div>
                      <div className="col-sm-6">
                        <div className="form-group">
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
                      <div className="col-sm-6">
                        <div className="form-group">
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
                      <div className="col-12">
                        <div className="form-group">
                          <Field
                            type="text"
                            className={`form-control w-75 ${
                              errors.subject && touched.subject
                                ? "is-invalid"
                                : ""
                            }`}
                            id="subject"
                            placeholder="Enter Subject...."
                            name="subject"
                          />
                          <small className="invalid-feedback">
                            <ErrorMessage name="subject" />
                          </small>
                        </div>
                      </div>
                      <div className="form-group mt-3 d-flex justify-content-end">
                        <button
                          type="submit"
                          className="button button-contactForm boxed-btn"
                        >
                          Send
                        </button>
                      </div>
                    </div>
                  </Form>
                )}
              </Formik>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Contact;
