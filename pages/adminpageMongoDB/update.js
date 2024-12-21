const session = db.getMongo().startSession();
const dbSession = session.getDatabase("sportshop");

try {

  session.startTransaction();

  const updatedProduct = {
    name: "Găng Tay Cụt Ngón Cao Cấp - Bao Tay Phượt Thủ Đa Năng",
    type: "clothes",
    price: 90000,
    quantity: 300,
    description: "Găng tay hở ngón chất lượng cao, thích hợp cho cả nam và nữ khi tập gym hoặc phượt",
    image: "https://salt.tikicdn.com/cache/750x750/ts/product/updated-image.jpg.webp"
  };

  const result = dbSession.product.updateOne(
    { id: 99 },
    {
      $set: {
        name: updatedProduct.name,
        type: updatedProduct.type,
        price: updatedProduct.price,
        quantity: updatedProduct.quantity,
        description: updatedProduct.description,
        image: updatedProduct.image
      }
    },
  );

  if (result.modifiedCount === 1) {
    session.commitTransaction();
    print("Cập nhật sản phẩm thành công!");
  } else {
    throw new Error("Không thể cập nhật sản phẩm");
  }
} catch (error) {

  session.abortTransaction();
  print("Có lỗi xảy ra: " + error.message);
} finally {

  session.endSession();
}
