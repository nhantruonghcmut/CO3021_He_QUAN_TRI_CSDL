const session = db.getMongo().startSession();
const dbSession = session.getDatabase("sportshop");

try {
  session.startTransaction();

  const result = dbSession.product.insertOne({
    id: 299,
    name: "Găng Tay Cụt Ngón, Bao Tay Tập Gym Thể Thao Đa Năng Dành Cho Phượt Thủ Phong Cách",
    type: "clothes",
    price: 82500,
    quantity: 347,
    description: "Găng tay hở ngón, bao tay phượt thủ dành cho cả nam và nữ",
    image: "https://salt.tikicdn.com/cache/750x750/ts/product/4c/c4/04/2c40b4e11780a0079dd18d6dd326e2a8.jpg.webp"
  });

  if (result.acknowledged) {
    session.commitTransaction();
    print("Thêm sản phẩm thành công!");
  } else {
    session.abortTransaction();
    throw new Error("Không thể thêm sản phẩm");
  }
} catch (error) {
  session.abortTransaction();
  print("Có lỗi xảy ra: " + error.message);
} finally {
  session.endSession();
}
