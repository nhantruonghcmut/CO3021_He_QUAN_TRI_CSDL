const session = db.getMongo().startSession();
const dbSession = session.getDatabase("sportshop").product;

try {
    session.startTransaction();
    const result = dbSession.product.deleteOne({ id: 399 });
    if (result.deletedCount === 1) {
        session.commitTransaction();
        print("Xóa sản phẩm thành công.");
    } else {
        session.abortTransaction();
        print("Không tìm thấy sản phẩm để xóa. Rollback transaction.");
    }
} catch (error) {
    session.abortTransaction();
    print("Lỗi xảy ra trong quá trình thực thi:", error.message);
} finally {
    session.endSession();
}
